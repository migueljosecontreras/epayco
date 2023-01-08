<?php

namespace App\Models;

use App\Casts\Common\Bcrypt;
use App\Rules\Common\Password;
use App\Traits\Common\ModelTrait;
use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, Authorizable, HasFactory, SoftDeletes, ModelTrait;

    protected $table = 'users';

    protected $casts = [
        'password' => Bcrypt::class,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'document',
        'name',
        'email',
        'role',
        'active',
        'password',
        'balance',
        'phone',
    ];

    /**
     * The attribute as a table name.
     *
     * @var array
     */
    public static function rules() : array
    {
        return [
            'document' => 'required|string|max:20|unique:users,document',
            'password' => ['required','min:8','max:15', new Password],
            'email'    => 'required|email|max:100|unique:users,email',
            'active'   => 'nullable|boolean',
            'phone'    => 'required|string|max:20|unique:users,phone',
            'name'     => 'required|string|max:100',
            'role'     => 'nullable|string|in:admin,client',
        ];
    }

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [ 'name' => $this->name, 'id' => $this->id, 'email' => $this->email ];
    }

    public function getUsernameAttribute()
    {
        return $this->email;
    }

    public function scopeFindUser($query)
    {
        $request = app('request');
        $currentUser = \Auth::user();

        $query->where('document', '=', @$request->document)
                       ->where('phone', '=', @$request->phone);

        if($currentUser->role != 'admin')
        {
            $query->where('id', '=', $currentUser->id)->first();
        }

        return $query;
    }

    public function recharges(){
        return $this->hasMany(Recharge::class);
    }

    public function orders(){
        return $this->hasMany(Order::class)->where('completed', '=', true);
    }

    public function allOrders(){
        return $this->hasMany(Order::class);
    }
}

<?php

namespace App\Models;

use App\Rules\Common\OrderBalance;
use App\Traits\Common\ModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use ModelTrait, SoftDeletes;

    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'amount',
        'token',
        'completed',
    ];

    protected $hidden = [
        'token'
    ];

    public static function rules() : array
    {
        return [
            'document' => 'required|exists:users,document,deleted_at,NULL',
            'phone'    => 'required|exists:users,phone,deleted_at,NULL',
            'amount'   => ['required','numeric','min:0', new OrderBalance],
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use App\Traits\Common\ModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recharge extends Model
{
    use ModelTrait, SoftDeletes;

    protected $table = 'recharges';

    protected $fillable = [
        'user_id',
        'amount',
    ];

    public static function rules() : array
    {
        return [
            'document' => 'required|exists:users,document,deleted_at,NULL',
            'phone'    => 'required|exists:users,phone,deleted_at,NULL',
            'amount'   => 'required|numeric|min:0',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

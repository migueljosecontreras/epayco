<?php

namespace App\Models;

use App\Traits\Common\ModelTrait;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use ModelTrait;

    protected $table = 'tokens';

    public $timestamps = false;

    public $hasLogs = false;

    protected $fillable = [
        'token',
        'user_id',
        'from',
        'type',
        'date'];
}


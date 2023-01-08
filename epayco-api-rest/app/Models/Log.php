<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Log extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'logs';
    public    $timestamps = false;

    protected $casts = [
        'data' => 'array'
    ];

    protected $hidden = [
        '_id'
    ];

    public function secureSave()
    {
        try
        {
            $this->save();

            return true;
        }
        catch(\Exception $e)
        {
            if(env('APP_DEBUG'))
            {
                dd($e->getMessage());
            }
            else
            {
                return false;
            }
        }
    }
}


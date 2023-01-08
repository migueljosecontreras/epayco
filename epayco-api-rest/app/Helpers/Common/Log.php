<?php

namespace App\Helpers\Common;

class Log {
    public static function write($action, $data = null, $table = null, $register_id = null) : bool{
        $log = new \App\Models\Log();

        $user = \Auth::user();

        if(!is_null($user))
        {
            $log->user_id = $user->id;
            $log->username    = $user->username;
        }
        else
        {
            $log->user_id = null;
            $log->username    = 'guest';
        }

        $log->data        = is_array($data) && count($data) > 0 ? $data : null;
        $log->date        = date('Y-m-d H:i:s');
        $log->action      = $action;
        $log->{'table'}   = $table;
        $log->register_id = $register_id;

        return $log->secureSave();
    }
}



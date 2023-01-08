<?php

namespace App\Traits\Common;

use App\Observers\LogObserver;

trait ModelTrait
{
    public static function boot()
    {
        parent::boot();

        if(self::getHasLogs())
        {
            self::observe(LogObserver::class, 1);
        }
    }

    public static function getHasSoftDeletes() : bool
    {
        return !( with(new static)->forceDeleting === true );
    }

    public static function getHasLogs() : bool
    {
        return !( with(new static)->hasLogs === false );
    }

    public static function getTableName()
    {
        return with(new static)->getTable();
    }

    public static function getPrimaryKeyName()
    {
        return with(new static)->getKeyName();
    }

    public function getAppliedChanges() : array
    {
        $except = [ 'updated_at' ];
        $after  = \Arr::except($this->getDirty(), $except);
        $before = \Arr::only($this->getOriginal(), array_keys($after));

        return [ 'before' => $before, 'after' => $after ];
    }

    public function hasAppliedChanges() : bool
    {
        $appliedChanges = $this->getAppliedChanges();

        return count($appliedChanges['before']) || count($appliedChanges['after']);
    }

    public static function getIdFromCode($code)
    {
        $data = with(new static)->where('code', '=', $code)->first();

        return @$data->id ?? null;
    }

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

    public function secureDelete()
    {
        try
        {
            $this->delete();

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

    public static function getFillables()
    {
        return with(new static)->getFillable();
    }

    #has many
    public function logs() : \Illuminate\Database\Eloquent\Relations\HasMany
    {
        //cuando sea necesario hacer uso de ésta relacion, colocar "use HybridRelations;" en el modelo como un trait
        return $this->hasMany('App\Models\Log', 'register_id', self::getKeyName())->where('table', '=', self::getTable())->orderBy('date', 'desc');
    }

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function scopeByUser($query, $user_id = null)
    {
        if(is_null($user_id))
        {
            $user = \Auth::user();
            if($user)
            {
                $user_id = $user->id;
            }
        }

        return $query->where('user_id', '=', $user_id);
    }
}

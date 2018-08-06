<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    //
    public function user ()
    {
        return $this->belongsTo(User::class);
    }

    public function monster ()
    {
        return $this->belongsTo(Monster::class);
    }

    public function runeset ()
    {
        return $this->hasOne(Runeset::class);
    }

    public static function searchByOld ($unit_id)
    {
        $unit = Unit::where('imported', '=', $unit_id)
            ->first();

        return $unit;
    }

    public static function getMonster (Unit $unit)
    {
        $monster = Monster::where('com2usid','=',$unit->monster_id)->first();

        return $monster;
    }
}

<?php

namespace App;

// use own model    use Illuminate\Database\Eloquent\Model;

class Runeset extends Model
{
    public function runes()
    {
        return $this->hasMany(Rune::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function unit()
    {
        return $this->hasOne(Unit::class);
    }
}

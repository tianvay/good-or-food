<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function json()
    {
        return $this->hasOne(json::class);
    }

    public function units()
    {
        return $this->hasMany(Unit::class);
    }

    public function runes()
    {
        return $this->hasMany(Rune::class);
    }

    public function guild()
    {
        return $this->belongsTo(Guild::class);
    }
    public function runesets()
    {
        return $this->hasMany(Runeset::class);
    }

}

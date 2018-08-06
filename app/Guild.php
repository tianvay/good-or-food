<?php

namespace App;

// use our own model    use Illuminate\Database\Eloquent\Model;

class Guild extends Model
{
    public function users ()
    {
        return $this->hasMany(User::class);
    }

    public static function getMembers($guildid)
    {
        $guild = Guild::find($guildid);
        $members = User::where('guild_id', '=', $guild->id)->get();
        return $members;
    }
}

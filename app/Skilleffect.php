<?php

namespace App;

//  using own model!  use Illuminate\Database\Eloquent\Model;

class Skilleffect extends Model
{
    //
    public function monsters()
    {
        return $this->belongsToMany(Monster::class);
    }
}

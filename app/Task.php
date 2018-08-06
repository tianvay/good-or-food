<?php

namespace App;

#using own model
#use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    public function scopeIncomplete($query)
    {
        return $query->where('completed', false);
    }
}

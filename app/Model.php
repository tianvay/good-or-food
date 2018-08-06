<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent
{
    //
    protected $guarded = [];


    public function getFormattedBodyAttribute()
    {
        #body definieren
        $body = htmlentities($this->body);
        #body modifizieren
        preg_match_all("/@@([a-z A-Z]+)@@/", $body, $found);

        if( count( $found[1] ) ) {
            // Es wurden Monster gefunden
            for( $i = 0; $i < count($found[1]); $i++ ) {
                $body = str_replace($found[0][$i], Monster::info($found[1][$i]), $body);

            }

        }
        return $body;
    }
}

<?php

namespace App;

// using our own model use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Monster extends Model
{
    //
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function addComment($body)
    {
        $user_id = auth()->id();
        $this->comments()->create(compact('body', 'user_id'));
    }

    public function skilleffects()
    {
        return $this->belongsToMany(Skilleffect::class);
    }

    public function scopeFilter($query, $filters)
    {

        if(!$filters){
            return $query;
        }
        if($element = $filters['element']){
            $query->where('element', $element);
        }
        if($name = $filters['name']){
            $query->where('name', 'LIKE', $name);
        }
    }

    public static function monsterOfTheDay()
    {
        $today = Carbon::today();

        $monster = Monster::where('motd','=',$today)
            ->first();
        #dd($monster);

        return $monster;
    }

    public static function random()
    {
        // old version
        // refactor to random monster ?

        $excludedMonsters = Monster::where(function($query) {
            $query
                ->where('awakens_from', 'NOT LIKE', '%Angelmon%')
                ->where('awakens_from', 'NOT LIKE', '%Rainbowmon%')
                ->where('awakens_from', 'NOT LIKE', '%Imperfect%')
                ->where('awakens_from', 'NOT LIKE', '%(Attack)%')
                ->where('awakens_from', 'NOT LIKE', '%(Support)%');
        });

        return $excludedMonsters
            ->whereNull('motd')
            ->whereNotNull('awakens_from')
            ->inRandomOrder()
            ->first();
    }

    public function bros()
    {
        return self::where('awakens_from', $this->awakens_from)
            ->whereNotNull('awakens_from')
            ->where('is_awakened', 1)
            ->orderBy('com2usid')
            ->get();
    }

    public static function info($name){

        try {
            $monster = Monster::where('name', 'LIKE', $name)->firstOrFail();

            return '<span style="display: inline-block">
                    <a title="(' . $monster->element . ' ' . $monster->awakens_from . ')" href="' . url('/monsters/' . $monster->id) . '">
                    <img src="' . asset('storage/data/images/' . $monster->pic) . '" width=24px>' . $monster->name . '</a></span>';
        } catch( \Exception $e ) {
            return $name;
        }

    }

    public function getFormattedArticleAttribute()
    {
        $body = htmlentities($this->article);
        #body modifizieren
        preg_match_all("/@@([a-z A-Z]+)@@/", $body, $found);

        if( count( $found[1] ) ) {
            // Es wurden Monster gefunden
            for( $i = 0; $i < count($found[1]); $i++ ) {
                $body = str_replace($found[0][$i], Monster::info($found[1][$i]), $body);

            }

        }
        #dd($body);
        return $body;
    }

    public function skillupstoskill($skillname)
    {
        $thisskillneeds = 0;

        $numberofskillups = explode("xxx", $this->$skillname);

        foreach($numberofskillups as $number){
            if($number != ''){

                $thisskillneeds++;
            }
            else{
                continue;
            }
        }

        return $thisskillneeds;
    }

    public function skillupstomax()
    {
        $max = 0;

        #iterate the skills
        for($i=1;$i<5;$i++) {
            $skillups = 's' . $i . 'level_progress_description';

            $max += $this->skillupstoskill($skillups);

        }

        return $max;
    }

    public function units ()
    {
        return $this->hasMany(Unit::class);
    }

    public static function searchByCom2usid ($com2usid)
    {
        $monster = Monster::where('com2usid', '=', $com2usid)
            ->first();

        return $monster;
    }
}

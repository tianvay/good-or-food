<?php

namespace App;

// using our own model use Illuminate\Database\Eloquent\Model;

class Rune extends Model
{
    //
    public static function goodorfood(Rune $rune)
    {


    }
    public function hasAttackerstats(Rune $rune)
    {


    }

    public static function efficiency (Rune $rune)
    {
        // Starting and Upgrade Values:
        $values = [
            'HP%' => 8,
            'DEF%' => 8,
            'Accuracy' => 8,
            'Resistance' => 8,
            'SPD' => 6,
            'CRI Rate' => 6,
            'CRI Dmg' => 7
        ];

        $eights = 0;
        $sixes = 0;
        $theseven = 0;

        for($i=1;$i<5;$i++){
            $substat = 'substat' . $i;
            $substat_value = $substat . '_value';
            $substat_grind = $substat . '_grind';

            switch ($rune->$substat){
                case 'HP%':
                    $eights = $eights + $rune->$substat_value + $rune->$substat_grind;
                    break;
                case 'DEF%':
                    $eights = $eights + $rune->$substat_value + $rune->$substat_grind;
                    break;
                case 'Accuracy':
                    $eights = $eights + $rune->$substat_value + $rune->$substat_grind;
                    break;
                case 'Resistance':
                    $eights = $eights + $rune->$substat_value + $rune->$substat_grind;
                    break;
                case 'SPD':
                    $sixes = $sixes + $rune->$substat_value + $rune->$substat_grind;
                    break;
                case 'CRI Rate':
                    $sixes = $sixes + $rune->$substat_value + $rune->$substat_grind;
                    break;
                case 'CRI Dmg':
                    $theseven = $theseven + $rune->$substat_value + $rune->$substat_grind;
                    break;
                default:
                    break;
            }
        }

        $eff = $eights / 40 + $sixes / 30 + $theseven / 35 +1;
        $efficiency = ($eff/2.8)*100;

        return round($efficiency, 2);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function runesets()
    {
        return $this->hasMany(Runeset::class);
    }


    public static function sets($int)
    {
        // Set Tabelle
        $sets = [
            '0' => 'undefined, check in database',
            '1' => 'Energy',
            '2' => 'Guard',
            '3' => 'Swift',
            '4' => 'Blade',
            '5' => 'Rage',
            '6' => 'Focus',
            '7' => 'Endure',
            '8' => 'Fatal',
            // unused set?
            #'9' => '???',
            '10' => 'Despair',
            '11' => 'Vampire',
            // unused set?
            #'12' => '???'
            '13' => 'Violent',
            '14' => 'Nemesis',
            '15' => 'Will',
            '16' => 'Shield',
            '17' => 'Revenge',
            '18' => 'Destroy',
            '19' => 'Fight',
            '20' => 'Determination',
            '21' => 'Enhance',
            '22' => 'Accuracy',
            '23' => 'Tolerance'
        ];

        $set = $sets[$int];

        return $set;
    }

    public static function stats($int)
    {
        // Stat Tabelle
        $statdecoding = [
            '0' => null,
            '1' => 'Flat HP',
            '2' => 'HP%',
            '3' => 'Flat ATK',
            '4' => 'ATK%',
            '5' => 'Flat DEF',
            '6' => 'DEF%',
            // unused value?
            #'7' => '???',
            '8' => 'SPD',
            '9' => 'CRI Rate',
            '10' => 'CRI Dmg',
            '11' => 'Resistance',
            '12' => 'Accuracy'
        ];

        $stat = $statdecoding[$int];

        return $stat;
    }
}

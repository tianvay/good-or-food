<?php

namespace App\Http\Controllers;

use App\Guild;
use App\json;
use App\Rune;
use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JSONController extends Controller
{
    //
    public function destroy (json $json)
    {
        // handle
        try {
            $user = auth()->user();
            $user->json_id = null;
            $user->guild_id = null;
            $user->runes()->delete();
            $user->units()->delete();
            $user->save();
            $json->delete();
        } catch (\Exception $e) {
            dd('failed to delete');
        };


        return redirect('/');
    }

    public function getdecoded (json $json)
    {
        // get user
        $user = $json->user;

        // get file location
        $file = Storage::url('json/' . $user->name .'/' . $json->filelocation);

        // grab file contents
        $contents = file_get_contents(url($file));

        // get json decoded
        $decoded = json_decode($contents);

        return $decoded;
    }

    public function show (json $json)
    {
        $decoded = $this->getdecoded($json);

        return view('json.show', compact('json','decoded'));
    }

    public function update(json $json)
    {
        // get decoded json contents
        $decoded = $this->getdecoded($json);

        // get user
        $user = auth()->user();

        // delete old runes and units before importing new ones
        Rune::where('user_id','=',$user->id)->delete();
        Unit::where('user_id','=',$user->id)->delete();

        // save guild if not in database
        #dd($decoded->guild);
        $guild = Guild::firstOrCreate([
            'name' => $decoded->guild->guild_info->name,
            'leader' => $decoded->guild->guild_info->master_wizard_name,
            'publicinfo' => $decoded->guild->guild_info->comment,
            'internalinfo' => $decoded->guild->guild_info->notice,
            'isrecruiting' => $decoded->guild->guild_info->recruit_status,
            'members' => $decoded->guild->guild_info->member_now
        ]);

        $guild->members = $decoded->guild->guild_info->member_now;
        $guild->update();

        $user->guild_id = $guild->id;
        $user->update();
        #$guild->save();



        // User levelup on first import!
        if(!isset($user->wizardid)) {
            $user->level = $user->level + 1;
            $user->wizardid = $decoded->wizard_info->wizard_id;
            $user->save();
        }



        // save runes from json
        foreach($decoded->runes as $runedata){
            $rune = new Rune;
            $rune->rune_id = $runedata->rune_id;
            $rune->wizard_id = $runedata->wizard_id;
            $rune->user_id = $user->id;
            $rune->class = $runedata->rank;
            $rune->slot = $runedata->slot_no;
            $rune->stars = $runedata->class;
            $rune->set = Rune::sets($runedata->set_id);
            $rune->mainstat = Rune::stats($runedata->pri_eff[0]);
            $rune->mainstat_value = $runedata->pri_eff[1];
            $rune->innate = Rune::stats($runedata->prefix_eff[0]);
            $rune->innate_value = $runedata->prefix_eff[1];
            // substats array:
            // 0 => welcher stat
            // 1 => höhe
            // 2 => ?
            // 3 => bonus durch grind

            // only start iterating if at least one substat present

            if(isset($runedata->sec_eff[0])){
                for($i = 0; $i<4; $i++){
                    if(isset($runedata->sec_eff[$i])){
                        $substring = 'substat' . ($i+1);
                        $rune->$substring = Rune::stats($runedata->sec_eff[$i][0]);

                        $substring = 'substat' . ($i+1) . '_value';
                        $rune->$substring = $runedata->sec_eff[$i][1];

                        $substring = 'substat' . ($i+1) . '_grind';
                        $rune->$substring = $runedata->sec_eff[$i][3];

                    }
                }
            }
            $rune->save();

        }

        // save units from json
        foreach($decoded->unit_list as $mon){
            $unit = new Unit();
            $unit->user_id = $user->id;
            $unit->monster_id = $mon->unit_master_id;
            $unit->imported = $mon->unit_id;

            // get runes on unit
            /*
            foreach($mon->runes as $rune){

            }
            */

            // save
            $unit->save();
        }


        return redirect('/users/' . $user->name);

    }

}

<?php

namespace App\Console\Commands;

use App\Monster;
use App\Skilleffect;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class MigrateSkilleffects extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:skilleffects';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        echo 'starting...';
        // get all files
        $files = Storage::disk('public')->files('data/monsters');

        // if no files found, tell me!
        if(!count($files)){
            dd('no files found' . storage_path('public'));
        }

        foreach($files as $file) {
            // get data out of the json file
            $data = json_decode(Storage::disk('public')->get($file));

            // data not usable or strange format? echo it out!
            if (!$data instanceof \stdClass) {
                echo $file . " \n";
                continue;
            }

            // iterate skills
            foreach($data->skills as $skill){
                // iterate skilleffects
                foreach($skill->skill_effect as $effect){
                    // if not in database, store as new effect
                    $type = $effect->is_buff == true ? 'buff' : 'debuff';

                    #dd($effect->description);
                    $effectdata = Skilleffect::firstOrCreate([
                        'name' => $effect->name,
                        'type' => $type,
                        'description' => $effect->description,
                        'icon_filename' => $effect->icon_filename
                        ]);

                    #dd($data->com2us_id);
                    $monster = Monster::where('com2usid', '=', $data->com2us_id)
                        ->first();

                    #dd($data->com2us_id, $monster);
                    $monster->skilleffects()->detach($effectdata->id);
                    $monster->skilleffects()->attach($effectdata->id);
                }

            }


        }
        echo 'done!';
    }
}

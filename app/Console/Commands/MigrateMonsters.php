<?php

namespace App\Console\Commands;

use App\Monster;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MigrateMonsters extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:monsters';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate Monsters from singular json files into database.';

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

        DB::table('monsters')->truncate();

        foreach($files as $file){
            // get data out of the json file
            $data = json_decode(Storage::disk('public')->get($file));

            // data not usable or strange format? echo it out!
            if(!$data instanceof \stdClass)
            {
                echo $file . " \n";
                continue;
            }


            try {
                $monster = new Monster([
                    'name' => $data->name,
                    'com2usid' => $data->com2us_id,
                    'is_awakened' => $data->is_awakened,
                    'fusion_food' => $data->fusion_food,
                    'awakens_from' => $data->awakens_from ? $data->awakens_from->name : null,
                    'awakens_to' => $data->awakens_to ? $data->awakens_to->name : null,
                    'element' => $data->element,
                    #'element_id' => $elId,   wird nicht gebraucht->com2usid
                    'pic' => $data->image_filename,
                    's1name' => isset($data->skills[0]) ? $data->skills[0]->name : null,
                    's1cd' => isset($data->skills[0]) ? $data->skills[0]->cooltime : null,
                    's1pic' => isset($data->skills[0]) ? $data->skills[0]->icon_filename : null,
                    's1level_progress_description' => isset($data->skills[0]) ? str_replace("\r", 'xxx', str_replace("\n", 'xxx', $data->skills[0]->level_progress_description)) : null,
                    's1description' => isset($data->skills[0]) ? $data->skills[0]->description : null,
                    's2name' => isset($data->skills[1]) ? $data->skills[1]->name : null,
                    's2cd' => isset($data->skills[1]) ? $data->skills[1]->cooltime : null,
                    's2pic' => isset($data->skills[1]) ? $data->skills[1]->icon_filename : null,
                    's2level_progress_description' => isset($data->skills[1]) ? str_replace("\r", 'xxx', str_replace("\n", 'xxx', $data->skills[1]->level_progress_description)) : null,
                    's2description' => isset($data->skills[1]) ? $data->skills[1]->description : null,
                    's3name' => isset($data->skills[2]) ? $data->skills[2]->name : null,
                    's3cd' => isset($data->skills[2]) ? $data->skills[2]->cooltime : null,
                    's3pic' => isset($data->skills[2]) ? $data->skills[2]->icon_filename : null,
                    's3level_progress_description' => isset($data->skills[2]) ? str_replace("\r", 'xxx', str_replace("\n", 'xxx', $data->skills[2]->level_progress_description)) : null,
                    's3description' => isset($data->skills[2]) ? $data->skills[2]->description : null,
                    's4name' => isset($data->skills[3]) ? $data->skills[3]->name : null,
                    's4cd' => isset($data->skills[3]) ? $data->skills[3]->cooltime : null,
                    's4pic' => isset($data->skills[3]) ? $data->skills[3]->icon_filename : null,
                    's4level_progress_description' => isset($data->skills[3]) ? str_replace("\r", 'xxx', str_replace("\n", 'xxx', $data->skills[3]->level_progress_description)) : null,
                    's4description' => isset($data->skills[3]) ? $data->skills[3]->description : null,
                    'type' => $data->archetype,
                    'leader_skill' => isset($data->leader_skill) ? 1 : null,
                    'leader_area' => isset($data->leader_skill->area) ? $data->leader_skill->area : null,
                    'leader_element' => isset($data->leader_skill->element) ? $data->leader_skill->element : null,
                    'leader_attribute' => isset($data->leader_skill->attribute) ? $data->leader_skill->attribute : null,
                    'leader_amount' => isset($data->leader_skill->amount) ? $data->leader_skill->amount : null,

                ]);



                $monster->save();

            } catch (\Exception $e ) {
                dd('err on monsters', $file, $e, $data->name, $data->com2us_id, $data->is_awakened, $data->awakens_from, $data->element, $data->archetype);
            }



        }

        echo 'done!';
    }
}

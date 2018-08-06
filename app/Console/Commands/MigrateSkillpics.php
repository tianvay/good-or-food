<?php

namespace App\Console\Commands;

use App\Monster;
use Illuminate\Console\Command;

class MigrateSkillpics extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:skillpics';

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
        // Fehler verhindern, dass das SSL-Zertifikat nicht überprüft werden kann
        $noSslVerifyContext = stream_context_create(['ssl' => [ 'verify_peer' => false, 'verify_peer_name' => false]]);

        $monsters = Monster::all();
        $failures = [];

        foreach($monsters as $monster) {
            // Skill Bilder vorhanden?

            for($i=1;$i<5;$i++){
                $skillpic = 's' . $i . 'pic';
                $filelocation = $monster->$skillpic;

                try {
                    // Skill Bild holen und abspeichern
                    $image = file_get_contents('https://swarfarm.com/static/herders/images/skills/' . $filelocation, false, $noSslVerifyContext);
                    file_put_contents('storage/app/public/data/images/' . $filelocation, $image);

                    echo " | saved image " . $filelocation . "\n";

                } catch (\Exception $e) {
                    echo 'MonsterID: ' . $monster->id . ' (' . $monster->name . ') ' . $skillpic, $filelocation;
                    continue;
                }
            }
        }

        dd($failures);
    }
}

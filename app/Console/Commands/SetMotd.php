<?php

namespace App\Console\Commands;

use App\Monster;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SetMotd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'set:motd';

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
        $monster = Monster::random();
        $today = Carbon::today();

        $monster->update([
            'motd' => $today
        ]);

        echo 'New MotD set to: ' . $monster->name;

        return $monster->id;
    }
}

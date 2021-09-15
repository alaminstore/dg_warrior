<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use App\User;

class everyDay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command run everyday';

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
     * @return int
     */
    public function handle()
    {
        DB::table('daily_checks')->delete();
        DB::table('subs_non_subs_limits')->delete();
        $subsUser = User::where('subscription','=',1)->get();
        foreach($subsUser as $usr){
            if($usr->balance>1){
                $usr->balance-=1;
                $usr->save();
            }else{
                $usr->subscription = 0;
                $usr->save();
            }
        }
        echo "table deleted done";
    }
}

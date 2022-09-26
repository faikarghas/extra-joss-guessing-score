<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Guessing;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Lib\UpdatePointHelper;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('inspire')->hourly();
        $schedule->call(function(){

            // $upPoint = new UpdatePointHelper();
            // $upPoint->updatePoint();

            $userNeedUpdate = Guessing::select('guessings.id','guessings.id_user','guessings.id_match','guessing_score_a','guessing_score_b','status')
        ->leftJoin('users','guessings.id_user','=','users.id')
        ->leftJoin('fmatches','guessings.id_match','=','fmatches.id')
        ->whereRaw(
            '(
                CASE
                    WHEN ( guessings.guessing_score_a = fmatches.score_a AND
                     guessings.guessing_score_b = fmatches.score_b ) THEN true ELSE false
                END
            )'
        )
        ->where([['fmatches.match_status','=',1],['guessings.status','=',0]])
        ->get();

        foreach ($userNeedUpdate as $key => $value) {
            if ($value->status == 0) {
                User::where([['id','=',$value->id_user]])
                ->increment('total_point', 3);
            }
        }

        foreach ($userNeedUpdate as $key => $value) {
            if ($value->status == 0) {
                Guessing::where([['id','=',$value->id]])
                ->update(['status'=>1]);
            }
        }

        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

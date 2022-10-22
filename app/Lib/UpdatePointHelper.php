<?php
namespace App\Lib;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Guessing;

class UpdatePointHelper{

    public function updatePoint(){

        // User yg menebak benar
        $userNeedUpdateForGuess = Guessing::select('guessings.id','guessings.id_user','guessings.id_match','guessing_score_a','guessing_score_b','guessings.status')
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
        ->where([['fmatches.match_status','=',"CLOSE"],['guessings.status','=',0],['guessings.is_guess','=',1]]) // pertandingan sudah selesai,staus update point masih 0 dan sudah ditebak
        ->get();

        foreach ($userNeedUpdateForGuess as $key => $value) {
            if ($value->status == 0) {
                User::where([['id','=',$value->id_user]])
                ->increment('total_point', 1000);
            }
        }

        foreach ($userNeedUpdateForGuess as $key => $value) {
            if ($value->status == 0) {
                Guessing::where([['id','=',$value->id]])
                ->update(['status'=>1,'guessing_result'=>1]);
            }
        }

        // dd($userNeedUpdate);
    }

}
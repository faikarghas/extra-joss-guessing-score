<?php
namespace App\Lib;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Guessing;
use App\Models\Round;

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

        $point = 1000;
        $round = Round::where('status',1)->get();
        if ($round[0]->id == 4) {
            $point = 2000;
        }

        if ($round[0]->id == 1) {
            foreach ($userNeedUpdateForGuess as $key => $value) {
                if ($value->status == 0) {
                    User::where([['id','=',$value->id_user]])
                    ->increment('point_1', $point);
                }
            }
        }

        if ($round[0]->id == 2) {
            foreach ($userNeedUpdateForGuess as $key => $value) {
                if ($value->status == 0) {
                    User::where([['id','=',$value->id_user]])
                    ->increment('point_2', $point);
                }
            }
        }

        if ($round[0]->id == 3) {
            foreach ($userNeedUpdateForGuess as $key => $value) {
                if ($value->status == 0) {
                    User::where([['id','=',$value->id_user]])
                    ->increment('point_3', $point);
                }
            }
        }

        if ($round[0]->id == 4) {
            foreach ($userNeedUpdateForGuess as $key => $value) {
                if ($value->status == 0) {
                    User::where([['id','=',$value->id_user]])
                    ->increment('point_4', $point);
                }
            }
        }

        foreach ($userNeedUpdateForGuess as $key => $value) {
            if ($value->status == 0) {
                User::where([['id','=',$value->id_user]])
                ->increment('total_point', $point);
            }
        }

        foreach ($userNeedUpdateForGuess as $key => $value) {
            if ($value->status == 0) {
                Guessing::where([['id','=',$value->id]])
                ->update(['status'=>1,'guessing_result'=>1]);
            }
        }

        // User yg menebak salah
        $userWrongGuess = Guessing::select('guessings.id','guessings.id_user','guessings.id_match','guessing_score_a','guessing_score_b','guessings.status')
        ->leftJoin('users','guessings.id_user','=','users.id')
        ->leftJoin('fmatches','guessings.id_match','=','fmatches.id')
        ->whereRaw(
            '(
                CASE
                    WHEN ( guessings.guessing_score_a != fmatches.score_a OR
                     guessings.guessing_score_b != fmatches.score_b ) THEN true ELSE false
                END
            )'
        )
        ->where([['fmatches.match_status','=',"CLOSE"],['guessings.status','=',0],['guessings.is_guess','=',1]]) // pertandingan sudah selesai,staus update point masih 0 dan sudah ditebak
        ->get();

        foreach ($userWrongGuess as $key => $value) {
            if ($value->status == 0) {
                Guessing::where([['id','=',$value->id]])
                ->update(['status'=>1,'guessing_result'=>0]);
            }
        }

    }

    public function updatePoint_4(){

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

        $userNeedUpdateFPenalty = Guessing::select('guessings.id','guessings.id_user','guessings.id_match','guessing_score_a','guessing_score_b','guessings.status')
        ->leftJoin('users','guessings.id_user','=','users.id')
        ->leftJoin('fmatches','guessings.id_match','=','fmatches.id')
        ->whereRaw(
            '(
                CASE
                    WHEN ( guessings.penalty_a = fmatches.penalty_m_a AND
                    guessings.penalty_b = fmatches.penalty_m_b ) THEN true ELSE false
                END
            )'
        )
        ->where([['fmatches.match_status','=',"CLOSE"],['guessings.status','=',0],['guessings.is_guess','=',1]]) // pertandingan sudah selesai,staus update point masih 0 dan sudah ditebak
        ->get();

        $userNeedUpdateF120 = Guessing::select('guessings.id','guessings.id_user','guessings.id_match','guessing_score_a','guessing_score_b','guessings.status')
        ->leftJoin('users','guessings.id_user','=','users.id')
        ->leftJoin('fmatches','guessings.id_match','=','fmatches.id')
        ->whereRaw(
            '(
                CASE
                    WHEN ( guessings.score1_a = fmatches.score1_m_a AND
                    guessings.score1_b = fmatches.score1_m_b ) THEN true ELSE false
                END
            )'
        )
        ->where([['fmatches.match_status','=',"CLOSE"],['guessings.status','=',0],['guessings.is_guess','=',1]]) // pertandingan sudah selesai,staus update point masih 0 dan sudah ditebak
        ->get();


        // dd($userNeedUpdateF120);

        $point = 1000;
        $round = Round::where('status',1)->get();
        if ($round[0]->id == 4) {
            $point = 2000;
        }

        if ($round[0]->id == 4) {
            foreach ($userNeedUpdateForGuess as $key => $value) {
                if ($value->status == 0) {
                    User::where([['id','=',$value->id_user]])
                    ->increment('point_4', $point);
                }
            }

            foreach ($userNeedUpdateF120 as $key => $value) {
                if ($value->status == 0) {
                    User::where([['id','=',$value->id_user]])
                    ->increment('point_4', $point);
                }
            }

            foreach ($userNeedUpdateFPenalty as $key => $value) {
                if ($value->status == 0) {
                    User::where([['id','=',$value->id_user]])
                    ->increment('point_4', $point);
                }
            }
        }

        foreach ($userNeedUpdateForGuess as $key => $value) {
            if ($value->status == 0) {
                User::where([['id','=',$value->id_user]])
                ->increment('total_point', $point);
            }
        }

        foreach ($userNeedUpdateF120 as $key => $value) {
            if ($value->status == 0) {
                User::where([['id','=',$value->id_user]])
                ->increment('total_point', $point);
            }
        }

        foreach ($userNeedUpdateFPenalty as $key => $value) {
            if ($value->status == 0) {
                User::where([['id','=',$value->id_user]])
                ->increment('total_point', $point);
            }
        }

        foreach ($userNeedUpdateForGuess as $key => $value) {
            if ($value->status == 0) {
                Guessing::where([['id','=',$value->id]])
                ->update(['status'=>1,'guessing_result'=>1]);
            }
        }

        // User yg menebak salah
        $userWrongGuess = Guessing::select('guessings.id','guessings.id_user','guessings.id_match','guessing_score_a','guessing_score_b','guessings.status')
        ->leftJoin('users','guessings.id_user','=','users.id')
        ->leftJoin('fmatches','guessings.id_match','=','fmatches.id')
        ->whereRaw(
            '(
                CASE
                    WHEN ( guessings.guessing_score_a != fmatches.score_a OR
                     guessings.guessing_score_b != fmatches.score_b ) THEN true ELSE false
                END
            )'
        )
        ->where([['fmatches.match_status','=',"CLOSE"],['guessings.status','=',0],['guessings.is_guess','=',1]]) // pertandingan sudah selesai,staus update point masih 0 dan sudah ditebak
        ->get();

        foreach ($userWrongGuess as $key => $value) {
            if ($value->status == 0) {
                Guessing::where([['id','=',$value->id]])
                ->update(['status'=>1,'guessing_result'=>0]);
            }
        }

    }
}
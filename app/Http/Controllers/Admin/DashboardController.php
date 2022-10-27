<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Lib\UpdatePointHelper;
use App\Models\Guessing;


use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index(){
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

        $data = [
            'userNeedUpdateForGuess' => count($userNeedUpdateForGuess) + count($userWrongGuess)
        ];

        return view('admin.dashboard.index',$data);
    }

    public function updateScore(){
        $upPoint = new UpdatePointHelper();
        $upPoint->updatePoint();

        return response()->json([
            'code' => '200',
            'message' => 'Success',
        ]);
    }
}

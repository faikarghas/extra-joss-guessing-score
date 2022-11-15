<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Lib\UpdatePointHelper;
use App\Models\Guessing;
use App\Models\User;
use Cache;


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

        $total_user = User::where('role',0)->get();

        $klasemens = User::where('role',0)
        ->orderBy('total_point','DESC')
        ->orderBy('name','ASC')
        ->get();

        $user_online = User::select("*")
                        ->whereNotNull('last_seen')
                        ->orderBy('last_seen', 'DESC')
                        ->paginate(10);
        $total_online = 0;
        foreach ($user_online as $key => $user) {
            if (Cache::has('user-is-online-' . $user->id)) {
                $total_online++;
            }
        }

        $data = [
            'userNeedUpdateForGuess' => count($userNeedUpdateForGuess) + count($userWrongGuess),
            'total_user' => count($total_user),
            'total_online' => $total_online,
            'klasemens' => $klasemens,
            'user_online' => $user_online
        ];

        return view('admin.dashboard.index',$data);
    }

    public function leaderboard(){

        $klasemens = User::where('role',0)
        ->orderBy('total_point','DESC')
        ->orderBy('name','ASC')
        ->get();


        $data = [
            'klasemens' => $klasemens,
        ];

        return view('admin.dashboard.leaderboard',$data);
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

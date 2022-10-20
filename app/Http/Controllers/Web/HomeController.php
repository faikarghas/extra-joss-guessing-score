<?php

namespace App\Http\Controllers\Web;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Questions;
use App\Models\QuestionChoices;
use App\Models\User;
use App\Models\Guessing;
use App\Models\Fmatch;
use App\Lib\UpdatePointHelper;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HomeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {



        // User yg menebak benar
        // $userGuess = Guessing::select('guessings.id','guessings.id_user','guessings.id_match','guessing_score_a','guessing_score_b','status')
        // ->leftJoin('users','guessings.id_user','=','users.id')
        // ->leftJoin('fmatches','guessings.id_match','=','fmatches.id')
        // ->whereRaw(
        //     '(
        //         CASE
        //             WHEN ( guessings.guessing_score_a = fmatches.score_a AND
        //             guessings.guessing_score_b = fmatches.score_b ) THEN true ELSE false
        //         END
        //     )'
        // )
        // ->where([['fmatches.match_status','=',1]])
        // ->get();

        // Daftar pertandingan
        $matches = Fmatch::join('countries as c1', 'fmatches.id_team_a', '=', 'c1.id')
        ->join('countries as c2', 'fmatches.id_team_b', '=', 'c2.id')
        ->join('rounds as c3', 'fmatches.round', '=', 'c3.id')
        ->select("fmatches.id","c1.name AS team1", "c2.name AS team2","score_a","score_b","stadium","match_time","expired_time","c3.title as round")
        ->where([["fmatches.match_status","OPEN"]])
        ->get();


        // Daftar tebakan user
        // $matches2 = Guessing::leftJoin('fmatches','guessings.id_match','=','fmatches.id')
        // ->join('countries as c1', 'fmatches.id_team_a', '=', 'c1.id')
        // ->join('countries as c2', 'fmatches.id_team_b', '=', 'c2.id')
        // ->select("fmatches.id","c1.name AS team1", "c2.name AS team2","guessing_score_a","guessing_score_b","score_a","score_b","round","stadium","match_time","expired_time")
        // ->get();

        //klasemen
        // $klasemens = User::orderBy('total_point','DESC')
        // ->orderBy('name','ASC')
        // ->get();

        // if (Auth::check()) {
        //     // Tebakan per user
        //     $myguess = Guessing::leftJoin('users','guessings.id_user','=','users.id')
        //     ->leftJoin('fmatches','guessings.id_match','=','fmatches.id')
        //     ->join('countries as c1', 'fmatches.id_team_a', '=', 'c1.id')
        //     ->join('countries as c2', 'fmatches.id_team_b', '=', 'c2.id')
        //     ->where('guessings.id_user',Auth::user()->id)
        //     ->select('guessings.id as id_guess','c1.name AS team1', 'c2.name AS team2','guessings.id_match as id_match','users.name','fmatches.round','guessing_score_a','guessing_score_b')
        //     ->get();
        // }

        // $test = Fmatch::where('round','Group Stage 1')
        // ->leftJoin('guessings', 'fmatches.id','guessings.id_match')
        // ->where('id_user',11)
        // ->get();

        // $userDetail=[];
        // if (Auth::check()) {
        //     $userDetail = [
        //         'email' => Auth::user()->email,
        //         'name' => Auth::user()->name,
        //         'point' => Auth::user()->total_point,
        //     ];
        // }

        $data = [
            //'klasemens' => $klasemens,
            'matches' => $matches,
            //'myguess' => $myguess,
            //'userDetail' => $userDetail
        ];

        return view('web.pages.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function update_t()
    {

        $upPoint = new UpdatePointHelper();
        $upPoint->updatePoint();

    }

    public function storeOrUpdateScore(Request $request,$id_match){
        $req = $request->all();

        $cn = Carbon::now()->toDateTimeString();
        $datetime = date($cn);
        $timestamp = strtotime($datetime);
        $time = $timestamp + (8 * 60 * 60);
        $currentTime = date("Y-m-d H:i:s", $time);

        $matchData = Fmatch::where('id',$id_match)->get();
        $matchDate = $matchData[0]['match_time'];

        // $d1 = new DateTime($currentTime);
        // $d2 = new DateTime($matchDate);

        // // expire
        if ($currentTime > $matchDate) {
            return response()->json([
                'code' => '200',
                'message' => 'Sudah expire'
            ],500);
        } else {
            Guessing::updateOrCreate(
                ['id_user'=>Auth::user()->id, 'id_match'=> $id_match],
                ['guessing_score_a' => $req['guess_score_a'],
                 'guessing_score_b' => $req['guess_score_b'],
                 'is_guess' => 1]
            );

            return response()->json([
                'code' => '200',
                'message' => 'Success',
            ]);
        }

    }

    public function guess($id_match){

        $match = Fmatch::join('countries as c1', 'fmatches.id_team_a', '=', 'c1.id')
        ->join('countries as c2', 'fmatches.id_team_b', '=', 'c2.id')
        ->select("fmatches.id","c1.name AS team1", "c2.name AS team2","round","stadium","match_time","match_expired_time")
        ->where([["fmatches.id","=",$id_match],["fmatches.round","Group Stage 1"]])
        ->get();


        $myguess = Guessing::leftJoin('users','guessings.id_user','=','users.id')
        ->leftJoin('fmatches','guessings.id_match','=','fmatches.id')
        ->join('countries as c1', 'fmatches.id_team_a', '=', 'c1.id')
        ->join('countries as c2', 'fmatches.id_team_b', '=', 'c2.id')
        ->where([['guessings.id_user','=',Auth::user()->id],['guessings.id_match','=',$id_match]])
        ->select('guessings.id as id_guess','c1.name AS team1', 'c2.name AS team2','guessings.id_match as id_match','users.name','fmatches.round','guessing_score_a','guessing_score_b')
        ->get();

        $data = [
            'match' => $match,
            'myguess' => $myguess
        ];
        return view('web.pages.match',$data);
    }

    public function ex(){

         // Daftar pertandingan
        $matches = Fmatch::join('countries as c1', 'fmatches.id_team_a', '=', 'c1.id')
        ->join('countries as c2', 'fmatches.id_team_b', '=', 'c2.id')
        ->join('rounds as c3', 'fmatches.round', '=', 'c3.id')
        ->select("fmatches.id","c1.name AS team1", "c2.name AS team2","score_a","score_b","stadium","match_time","expired_time","c3.title as round","c1.flag_image as flag_team1","c2.flag_image as flag_team2","match_status","c1.group")
        ->where([["fmatches.match_status","OPEN"]])
        ->get();

        // GMT +8
        $cn = Carbon::now()->toDateTimeString();
        $datetime = date($cn);
        $timestamp = strtotime($datetime);
        $time = $timestamp + (8 * 60 * 60);
        $currentTime = date("Y-m-d H:i:s", $time);
        $myguess = [];

        if (Auth::check()) {
            // Tebakan per user
            $myguess = Guessing::leftJoin('users','guessings.id_user','=','users.id')
            ->leftJoin('fmatches','guessings.id_match','=','fmatches.id')
            ->join('countries as c1', 'fmatches.id_team_a', '=', 'c1.id')
            ->join('countries as c2', 'fmatches.id_team_b', '=', 'c2.id')
            ->join('rounds as c3', 'fmatches.round', '=', 'c3.id')
            ->select('guessings.id as id_guess','c1.name AS team1', 'c2.name AS team2','guessings.id_match as id_match','users.name','fmatches.round','guessing_score_a','guessing_score_b','c1.flag_image as flag_team1','c2.flag_image as flag_team2','c3.title as round','match_time','is_guess','c1.group')
            ->where([['guessings.id_user',Auth::user()->id],["fmatches.match_status","OPEN"]])
            ->get();

            // dd($myguess);
        }

        $data = [
            'matches' => $matches,
            'currentTime' => $currentTime,
            'myguess' => $myguess
        ];

        return view('web.pages.ex',$data);
    }

    public function daftar(){
        return view('web.pages.register');
    }

    public function masuk(){
        return view('web.pages.login');
    }

    public function storeGuess(){
        $matches = Fmatch::join('countries as c1', 'fmatches.id_team_a', '=', 'c1.id')
        ->join('countries as c2', 'fmatches.id_team_b', '=', 'c2.id')
        ->join('rounds as c3', 'fmatches.round', '=', 'c3.id')
        ->select("fmatches.id","c1.name AS team1", "c2.name AS team2","score_a","score_b","stadium","match_time","expired_time","c3.title as round","c1.flag_image as flag_team1","c2.flag_image as flag_team2","match_status")
        ->get();

        foreach ($matches as $key => $match) {
            Guessing::updateOrCreate([
                'id_user'   => Auth::user()->id,
                'id_match'  => $match->id,
            ],[
                'guessing_score_a' => 0,
                'guessing_score_b' => 0,
            ]);
        }
    }

     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome()
    {
        return view('adminHome');
    }

    public function getQuiz()
    {
        $soal = Questions::all();
        $option =  QuestionChoices::all();

        return response()->json(array('soal'=>$soal,'jawaban'=>$option));

    }

}

<?php

namespace App\Http\Controllers\Web;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Questions;
use App\Models\QuestionChoices;
use App\Models\UserQuestionAnswers;
use App\Models\User;
use App\Models\Guessing;
use App\Models\Fmatch;
use App\Models\Post;
use App\Models\QuizIndicator;
use App\Models\Province;
use App\Models\Regencie;
use App\Models\Round;
use App\Lib\UpdatePointHelper;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        // GMT +7
        $cn = Carbon::now()->toDateTimeString();
        $datetime = date($cn);
        $timestamp = strtotime($datetime);
        $time = $timestamp + (7 * 60 * 60);
        $currentTime = date("Y-m-d H:i:s", $time);

        $myguess=[];
        $myranking=[];
        $myguessRound16=[];
        $myguessQuarter=[];
        $myguessSemiFinal=[];
        $myguessFinal=[];
        $checkQuiz=[];

        // current round
        $round = Round::where('status',1)->get();
        // Daftar pertandingan group
        $matches = Fmatch::join('countries as c1', 'fmatches.id_team_a', '=', 'c1.id')
        ->join('countries as c2', 'fmatches.id_team_b', '=', 'c2.id')
        ->join('rounds as c3', 'fmatches.round', '=', 'c3.id')
        ->select("fmatches.id","c1.name AS team1", "c2.name AS team2","score_a","score_b","stadium","match_time","expired_time","c3.title as round","c1.flag_image as flag_team1","c2.flag_image as flag_team2","match_status","c1.group")
        ->where([["fmatches.status","1"],["fmatches.round","=",$round[0]->id]])
        ->get();

        // Daftar 16 besar
        $match_round_16 = Fmatch::join('countries as c1', 'fmatches.id_team_a', '=', 'c1.id')
        ->join('countries as c2', 'fmatches.id_team_b', '=', 'c2.id')
        ->join('rounds as c3', 'fmatches.round', '=', 'c3.id')
        ->select("fmatches.id","c1.name AS team1", "c2.name AS team2","score_a","score_b","stadium","match_time","expired_time","c3.title as round","c1.flag_image as flag_team1","c2.flag_image as flag_team2","match_status","c1.group")
        ->where([["fmatches.status","1"],["fmatches.round","5"]])
        ->get();

        // Daftar quarter final
        $match_quarter = Fmatch::join('countries as c1', 'fmatches.id_team_a', '=', 'c1.id')
        ->join('countries as c2', 'fmatches.id_team_b', '=', 'c2.id')
        ->join('rounds as c3', 'fmatches.round', '=', 'c3.id')
        ->select("fmatches.id","c1.name AS team1", "c2.name AS team2","score_a","score_b","stadium","match_time","expired_time","c3.title as round","c1.flag_image as flag_team1","c2.flag_image as flag_team2","match_status","c1.group")
        ->where([["fmatches.status","1"],["fmatches.round","6"]])
        ->get();

        // Daftar semi final
        $match_semi_finals = Fmatch::join('countries as c1', 'fmatches.id_team_a', '=', 'c1.id')
        ->join('countries as c2', 'fmatches.id_team_b', '=', 'c2.id')
        ->join('rounds as c3', 'fmatches.round', '=', 'c3.id')
        ->select("fmatches.id","c1.name AS team1", "c2.name AS team2","score_a","score_b","stadium","match_time","expired_time","c3.title as round","c1.flag_image as flag_team1","c2.flag_image as flag_team2","match_status","c1.group")
        ->where([["fmatches.status","1"],["fmatches.round","7"]])
        ->get();

        // Daftar  final
        $match_final = Fmatch::join('countries as c1', 'fmatches.id_team_a', '=', 'c1.id')
        ->join('countries as c2', 'fmatches.id_team_b', '=', 'c2.id')
        ->join('rounds as c3', 'fmatches.round', '=', 'c3.id')
        ->select("fmatches.id","c1.name AS team1", "c2.name AS team2","score_a","score_b","stadium","match_time","expired_time","c3.title as round","c1.flag_image as flag_team1","c2.flag_image as flag_team2","match_status","c1.group")
        ->where([["fmatches.status","1"],["fmatches.round","9"]])
        ->get();

        // Pertandingan berlangsung
        $onGoingMatches=[];
        foreach ($matches as $key => $match) {
            $datetime2 = date($match->match_time);
            $timestamp2 = strtotime($datetime2);
            $time2 = $timestamp2 + (2 * 60 * 60);
            $endMatchTime = date("Y-m-d H:i:s", $time2);

            if ($currentTime >= $match->match_time && $currentTime <= $endMatchTime) {
                array_push($onGoingMatches,$match);
            }
        }

        // Hasil pertandingan terakhir
        $twoLatestMatch = Fmatch::join('countries as c1', 'fmatches.id_team_a', '=', 'c1.id')
        ->join('countries as c2', 'fmatches.id_team_b', '=', 'c2.id')
        ->join('rounds as c3', 'fmatches.round', '=', 'c3.id')
        ->select("fmatches.id","c1.name AS team1", "c2.name AS team2","score_a","score_b","stadium","match_time","expired_time","c3.title as round","c1.flag_image as flag_team1","c2.flag_image as flag_team2","match_status","c1.group")
        ->where([["fmatches.match_status","CLOSE"]])
        ->orderBy('match_time','DESC')
        ->limit(2)
        ->get();

        $latestMatch = [];
        foreach ($twoLatestMatch as $key => $value) {
            if(count($twoLatestMatch) > 0){
                if ($twoLatestMatch[0]->match_time == $twoLatestMatch[1]->match_time) {
                    array_push($latestMatch,$value);
                }
            }
        }

        if (count($latestMatch) == 0) {
            if(count($twoLatestMatch) > 0){
            array_push($latestMatch,$twoLatestMatch[0]);
            }
        }

        if (Auth::check()) {
            // Tebakan per user
            $myguess = Guessing::leftJoin('users','guessings.id_user','=','users.id')
            ->leftJoin('fmatches','guessings.id_match','=','fmatches.id')
            ->join('countries as c1', 'fmatches.id_team_a', '=', 'c1.id')
            ->join('countries as c2', 'fmatches.id_team_b', '=', 'c2.id')
            ->join('rounds as c3', 'fmatches.round', '=', 'c3.id')
            ->select('guessings.id as id_guess','c1.name AS team1', 'c2.name AS team2','guessings.id_match as id_match','users.name','fmatches.round','guessing_score_a','guessing_score_b','c1.flag_image as flag_team1','c2.flag_image as flag_team2','c3.title as round','match_time','is_guess','c1.group','guessing_result')
            ->where([['guessings.id_user',Auth::user()->id],["fmatches.status","1"],["fmatches.round","=",$round[0]->id]])
            ->get();

            $myguessRound16 = Guessing::leftJoin('users','guessings.id_user','=','users.id')
            ->leftJoin('fmatches','guessings.id_match','=','fmatches.id')
            ->join('countries as c1', 'fmatches.id_team_a', '=', 'c1.id')
            ->join('countries as c2', 'fmatches.id_team_b', '=', 'c2.id')
            ->join('rounds as c3', 'fmatches.round', '=', 'c3.id')
            ->select('guessings.id as id_guess','c1.name AS team1', 'c2.name AS team2','guessings.id_match as id_match','users.name','fmatches.round','guessing_score_a','guessing_score_b','c1.flag_image as flag_team1','c2.flag_image as flag_team2','c3.title as round','match_time','is_guess','c1.group','guessing_result')
            ->where([['guessings.id_user',Auth::user()->id],["fmatches.status","1"],["fmatches.round","5"]])
            ->get();

            $myguessQuarter = Guessing::leftJoin('users','guessings.id_user','=','users.id')
            ->leftJoin('fmatches','guessings.id_match','=','fmatches.id')
            ->join('countries as c1', 'fmatches.id_team_a', '=', 'c1.id')
            ->join('countries as c2', 'fmatches.id_team_b', '=', 'c2.id')
            ->join('rounds as c3', 'fmatches.round', '=', 'c3.id')
            ->select('guessings.id as id_guess','c1.name AS team1', 'c2.name AS team2','guessings.id_match as id_match','users.name','fmatches.round','guessing_score_a','guessing_score_b','c1.flag_image as flag_team1','c2.flag_image as flag_team2','c3.title as round','match_time','is_guess','c1.group','guessing_result')
            ->where([['guessings.id_user',Auth::user()->id],["fmatches.status","1"],["fmatches.round","6"]])
            ->get();

            $myguessSemiFinal = Guessing::leftJoin('users','guessings.id_user','=','users.id')
            ->leftJoin('fmatches','guessings.id_match','=','fmatches.id')
            ->join('countries as c1', 'fmatches.id_team_a', '=', 'c1.id')
            ->join('countries as c2', 'fmatches.id_team_b', '=', 'c2.id')
            ->join('rounds as c3', 'fmatches.round', '=', 'c3.id')
            ->select('guessings.id as id_guess','c1.name AS team1', 'c2.name AS team2','guessings.id_match as id_match','users.name','fmatches.round','guessing_score_a','guessing_score_b','c1.flag_image as flag_team1','c2.flag_image as flag_team2','c3.title as round','match_time','is_guess','c1.group','guessing_result')
            ->where([['guessings.id_user',Auth::user()->id],["fmatches.status","1"],["fmatches.round","7"]])
            ->get();

            $myguessFinal = Guessing::leftJoin('users','guessings.id_user','=','users.id')
            ->leftJoin('fmatches','guessings.id_match','=','fmatches.id')
            ->join('countries as c1', 'fmatches.id_team_a', '=', 'c1.id')
            ->join('countries as c2', 'fmatches.id_team_b', '=', 'c2.id')
            ->join('rounds as c3', 'fmatches.round', '=', 'c3.id')
            ->select('guessings.id as id_guess','c1.name AS team1', 'c2.name AS team2','guessings.id_match as id_match','users.name','fmatches.round','guessing_score_a','guessing_score_b','c1.flag_image as flag_team1','c2.flag_image as flag_team2','c3.title as round','match_time','is_guess','c1.group','guessing_result')
            ->where([['guessings.id_user',Auth::user()->id],["fmatches.status","1"],["fmatches.round","9"]])
            ->get();

            $listranking = User::select(DB::raw('ROW_NUMBER() OVER(ORDER BY total_point DESC) AS rank,name,total_point,id'))
            ->where('role',0)
            ->orderBy('total_point','DESC')
            ->get();

            $currenRound = $round[0]->id;

            $checkQuiz = QuizIndicator::where([['id_user',Auth::user()->id],['quiz_'.$currenRound,1]])->get();


            foreach ($listranking as $key => $data) {
                if ($data->id == Auth::user()->id) {
                    array_push($myranking,$data);
                }
            }

        }

        $klasemens = User::where('role',0)
        ->orderBy('total_point','DESC')
        ->orderBy('name','ASC')
        ->limit(8)->get();

        $totalp = User::where('role',0)
        ->get();

        $totalPage = (int) ceil(count($totalp) / 16);

        $data = [
            'latestMatch' => $latestMatch,
            'onGoingMatches' => $onGoingMatches,
            'matches' => $matches,
            'match_round_16' => $match_round_16,
            'match_quarter' => $match_quarter,
            'match_semi_finals' => $match_semi_finals,
            'match_final' => $match_final,
            'currentTime' => $currentTime,
            'myguess' => $myguess,
            'myguessRound16' => $myguessRound16,
            'myguessQuarter' => $myguessQuarter,
            'myguessSemiFinal' => $myguessSemiFinal,
            'myguessFinal' => $myguessFinal,
            'klasemens' => $klasemens,
            'myranking' => $myranking,
            'checkQuiz' => $checkQuiz,
            'round' => $round,
            'totalPage' => $totalPage
        ];

        return view('web.pages.index',$data);
    }


    public function daftar(){

        $data = [
            'province' => Province::all(),
            'regencie' => Regencie::all()
        ];

        return view('web.pages.register',$data);
    }

    public function masuk(){
        return view('web.pages.login');
    }

    public function belanja(){
       return view('web.pages.belanja');
    }

    public function mekanisme(){
        $mekanisme = Post::where('slug','mekanisme')->get();
        $data = [
            'mekanisme' => $mekanisme
        ];
        return view('web.pages.mekanisme',$data);
     }


     public function hadiah(){
        $hadiah = Post::where('slug','hadiah')->get();
        $data = [
            'hadiah' => $hadiah
        ];
        return view('web.pages.hadiah',$data);
    }

    public function profil(){
        $profil = User::where('id',Auth::user()->id)->get();
        //dd($profil);
        $data = [
            'profil' => $profil,
            'province' => Province::all(),
            'regencie' => Regencie::all()
        ];
        return view('web.pages.profil',$data);
    }

    public function hasilKlasemen(){
        $myguess1=[];
        $myguess2=[];
        $myguess3=[];
        $myguessRound16=[];
        $myguessQuarter=[];
        $myguessSemiFinal=[];
        $myguessFinal=[];
        // GMT +7
        $cn = Carbon::now()->toDateTimeString();
        $datetime = date($cn);
        $timestamp = strtotime($datetime);
        $time = $timestamp + (7 * 60 * 60);
        $currentTime = date("Y-m-d H:i:s", $time);

        $matches1 = Fmatch::join('countries as c1', 'fmatches.id_team_a', '=', 'c1.id')
        ->join('countries as c2', 'fmatches.id_team_b', '=', 'c2.id')
        ->join('rounds as c3', 'fmatches.round', '=', 'c3.id')
        ->select("fmatches.id","c1.name AS team1", "c2.name AS team2","score_a","score_b","stadium","match_time","expired_time","c3.title as round","c1.flag_image as flag_team1","c2.flag_image as flag_team2","match_status","c1.group")
        ->where([["fmatches.round","=","1"]])
        ->get();

        $matches2 = Fmatch::join('countries as c1', 'fmatches.id_team_a', '=', 'c1.id')
        ->join('countries as c2', 'fmatches.id_team_b', '=', 'c2.id')
        ->join('rounds as c3', 'fmatches.round', '=', 'c3.id')
        ->select("fmatches.id","c1.name AS team1", "c2.name AS team2","score_a","score_b","stadium","match_time","expired_time","c3.title as round","c1.flag_image as flag_team1","c2.flag_image as flag_team2","match_status","c1.group")
        ->where([["fmatches.round","=","2"]])
        ->get();

        $matches3 = Fmatch::join('countries as c1', 'fmatches.id_team_a', '=', 'c1.id')
        ->join('countries as c2', 'fmatches.id_team_b', '=', 'c2.id')
        ->join('rounds as c3', 'fmatches.round', '=', 'c3.id')
        ->select("fmatches.id","c1.name AS team1", "c2.name AS team2","score_a","score_b","stadium","match_time","expired_time","c3.title as round","c1.flag_image as flag_team1","c2.flag_image as flag_team2","match_status","c1.group")
        ->where([["fmatches.round","=","3"]])
        ->get();

        // Daftar 16 besar
        $match_round_16 = Fmatch::join('countries as c1', 'fmatches.id_team_a', '=', 'c1.id')
        ->join('countries as c2', 'fmatches.id_team_b', '=', 'c2.id')
        ->join('rounds as c3', 'fmatches.round', '=', 'c3.id')
        ->select("fmatches.id","c1.name AS team1", "c2.name AS team2","score_a","score_b","stadium","match_time","expired_time","c3.title as round","c1.flag_image as flag_team1","c2.flag_image as flag_team2","match_status","c1.group")
        ->where([["fmatches.status","1"],["fmatches.round","5"]])
        ->get();

        // Daftar quarter final
        $match_quarter = Fmatch::join('countries as c1', 'fmatches.id_team_a', '=', 'c1.id')
        ->join('countries as c2', 'fmatches.id_team_b', '=', 'c2.id')
        ->join('rounds as c3', 'fmatches.round', '=', 'c3.id')
        ->select("fmatches.id","c1.name AS team1", "c2.name AS team2","score_a","score_b","stadium","match_time","expired_time","c3.title as round","c1.flag_image as flag_team1","c2.flag_image as flag_team2","match_status","c1.group")
        ->where([["fmatches.status","1"],["fmatches.round","6"]])
        ->get();

        // Daftar semi final
        $match_semi_finals = Fmatch::join('countries as c1', 'fmatches.id_team_a', '=', 'c1.id')
        ->join('countries as c2', 'fmatches.id_team_b', '=', 'c2.id')
        ->join('rounds as c3', 'fmatches.round', '=', 'c3.id')
        ->select("fmatches.id","c1.name AS team1", "c2.name AS team2","score_a","score_b","stadium","match_time","expired_time","c3.title as round","c1.flag_image as flag_team1","c2.flag_image as flag_team2","match_status","c1.group")
        ->where([["fmatches.status","1"],["fmatches.round","7"]])
        ->get();

        // Daftar  final
        $match_final = Fmatch::join('countries as c1', 'fmatches.id_team_a', '=', 'c1.id')
        ->join('countries as c2', 'fmatches.id_team_b', '=', 'c2.id')
        ->join('rounds as c3', 'fmatches.round', '=', 'c3.id')
        ->select("fmatches.id","c1.name AS team1", "c2.name AS team2","score_a","score_b","stadium","match_time","expired_time","c3.title as round","c1.flag_image as flag_team1","c2.flag_image as flag_team2","match_status","c1.group")
        ->where([["fmatches.status","1"],["fmatches.round","9"]])
        ->get();

        if (Auth::check()) {
            // Tebakan per user
            $myguess1 = Guessing::leftJoin('users','guessings.id_user','=','users.id')
            ->leftJoin('fmatches','guessings.id_match','=','fmatches.id')
            ->join('countries as c1', 'fmatches.id_team_a', '=', 'c1.id')
            ->join('countries as c2', 'fmatches.id_team_b', '=', 'c2.id')
            ->join('rounds as c3', 'fmatches.round', '=', 'c3.id')
            ->select('guessings.id as id_guess','c1.name AS team1', 'c2.name AS team2','guessings.id_match as id_match','users.name','fmatches.round','guessing_score_a','guessing_score_b','score_a','score_b','c1.flag_image as flag_team1','c2.flag_image as flag_team2','c3.title as round','match_time','is_guess','c1.group','guessing_result')
            ->where([['guessings.id_user',Auth::user()->id],["fmatches.status","1"],["fmatches.round","=","1"]])
            ->get();

            $myguess2 = Guessing::leftJoin('users','guessings.id_user','=','users.id')
            ->leftJoin('fmatches','guessings.id_match','=','fmatches.id')
            ->join('countries as c1', 'fmatches.id_team_a', '=', 'c1.id')
            ->join('countries as c2', 'fmatches.id_team_b', '=', 'c2.id')
            ->join('rounds as c3', 'fmatches.round', '=', 'c3.id')
            ->select('guessings.id as id_guess','c1.name AS team1', 'c2.name AS team2','guessings.id_match as id_match','users.name','fmatches.round','guessing_score_a','guessing_score_b','score_a','score_b','c1.flag_image as flag_team1','c2.flag_image as flag_team2','c3.title as round','match_time','is_guess','c1.group','guessing_result')
            ->where([['guessings.id_user',Auth::user()->id],["fmatches.status","1"],["fmatches.round","=","2"]])
            ->get();

            $myguess3 = Guessing::leftJoin('users','guessings.id_user','=','users.id')
            ->leftJoin('fmatches','guessings.id_match','=','fmatches.id')
            ->join('countries as c1', 'fmatches.id_team_a', '=', 'c1.id')
            ->join('countries as c2', 'fmatches.id_team_b', '=', 'c2.id')
            ->join('rounds as c3', 'fmatches.round', '=', 'c3.id')
            ->select('guessings.id as id_guess','c1.name AS team1', 'c2.name AS team2','guessings.id_match as id_match','users.name','fmatches.round','guessing_score_a','guessing_score_b','score_a','score_b','c1.flag_image as flag_team1','c2.flag_image as flag_team2','c3.title as round','match_time','is_guess','c1.group','guessing_result')
            ->where([['guessings.id_user',Auth::user()->id],["fmatches.status","1"],["fmatches.round","=","3"]])
            ->get();

            $myguessRound16 = Guessing::leftJoin('users','guessings.id_user','=','users.id')
            ->leftJoin('fmatches','guessings.id_match','=','fmatches.id')
            ->join('countries as c1', 'fmatches.id_team_a', '=', 'c1.id')
            ->join('countries as c2', 'fmatches.id_team_b', '=', 'c2.id')
            ->join('rounds as c3', 'fmatches.round', '=', 'c3.id')
            ->select('guessings.id as id_guess','c1.name AS team1', 'c2.name AS team2','guessings.id_match as id_match','users.name','fmatches.round','guessing_score_a','guessing_score_b','c1.flag_image as flag_team1','c2.flag_image as flag_team2','c3.title as round','match_time','is_guess','c1.group','guessing_result')
            ->where([['guessings.id_user',Auth::user()->id],["fmatches.status","1"],["fmatches.round","5"]])
            ->get();

            $myguessQuarter = Guessing::leftJoin('users','guessings.id_user','=','users.id')
            ->leftJoin('fmatches','guessings.id_match','=','fmatches.id')
            ->join('countries as c1', 'fmatches.id_team_a', '=', 'c1.id')
            ->join('countries as c2', 'fmatches.id_team_b', '=', 'c2.id')
            ->join('rounds as c3', 'fmatches.round', '=', 'c3.id')
            ->select('guessings.id as id_guess','c1.name AS team1', 'c2.name AS team2','guessings.id_match as id_match','users.name','fmatches.round','guessing_score_a','guessing_score_b','c1.flag_image as flag_team1','c2.flag_image as flag_team2','c3.title as round','match_time','is_guess','c1.group','guessing_result')
            ->where([['guessings.id_user',Auth::user()->id],["fmatches.status","1"],["fmatches.round","6"]])
            ->get();

            $myguessSemiFinal = Guessing::leftJoin('users','guessings.id_user','=','users.id')
            ->leftJoin('fmatches','guessings.id_match','=','fmatches.id')
            ->join('countries as c1', 'fmatches.id_team_a', '=', 'c1.id')
            ->join('countries as c2', 'fmatches.id_team_b', '=', 'c2.id')
            ->join('rounds as c3', 'fmatches.round', '=', 'c3.id')
            ->select('guessings.id as id_guess','c1.name AS team1', 'c2.name AS team2','guessings.id_match as id_match','users.name','fmatches.round','guessing_score_a','guessing_score_b','c1.flag_image as flag_team1','c2.flag_image as flag_team2','c3.title as round','match_time','is_guess','c1.group','guessing_result')
            ->where([['guessings.id_user',Auth::user()->id],["fmatches.status","1"],["fmatches.round","7"]])
            ->get();

            $myguessFinal = Guessing::leftJoin('users','guessings.id_user','=','users.id')
            ->leftJoin('fmatches','guessings.id_match','=','fmatches.id')
            ->join('countries as c1', 'fmatches.id_team_a', '=', 'c1.id')
            ->join('countries as c2', 'fmatches.id_team_b', '=', 'c2.id')
            ->join('rounds as c3', 'fmatches.round', '=', 'c3.id')
            ->select('guessings.id as id_guess','c1.name AS team1', 'c2.name AS team2','guessings.id_match as id_match','users.name','fmatches.round','guessing_score_a','guessing_score_b','c1.flag_image as flag_team1','c2.flag_image as flag_team2','c3.title as round','match_time','is_guess','c1.group','guessing_result')
            ->where([['guessings.id_user',Auth::user()->id],["fmatches.status","1"],["fmatches.round","9"]])
            ->get();
        }

        $data = [
            'currentTime' => $currentTime,
            'matches1' => $matches1,
            'matches2' => $matches2,
            'matches3' => $matches3,
            'myguess1'  => $myguess1,
            'myguess2'  => $myguess2,
            'myguess3'  => $myguess3,
            'match_round_16' => $match_round_16,
            'match_quarter' => $match_quarter,
            'match_semi_finals' => $match_semi_finals,
            'match_final' => $match_final,
            'myguessRound16' => $myguessRound16,
            'myguessQuarter' => $myguessQuarter,
            'myguessSemiFinal' => $myguessSemiFinal,
            'myguessFinal' => $myguessFinal
        ];

        return view('web.pages.hasil',$data);
    }

    public function updateprofil(Request $request, $id)
    {
        $profile = User::find($id);
        $profile->name= $request->input('nama');
        $profile->email= $request->input('email');
        $profile->username= $request->input('username');
        $profile->phone= $request->input('phone');
        $profile->nik= $request->input('nik');
        $profile->kota= $request->input('provinsi');
        $profile->kecamatan= $request->input('city');
        $profile->address= $request->input('address');
        $profile->size_jersey= $request->input('size_jersey');
        $profile->size_sepatu= $request->input('size_sepatu');

        $profile->save();

        return redirect()->route('home');
    }
    // bulk create guessing
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

    public function update_t()
    {

        $upPoint = new UpdatePointHelper();
        $upPoint->updatePoint();

        // $userNeedUpdateForQuiz = UserQuestionAnswers::select('users.id','users.name','user_question_answers.status','user_question_answers.question_id','user_question_answers.choice_id','question_choices.point','question_choices.choice')
        // ->leftJoin('question_choices','user_question_answers.choice_id','=','question_choices.id')
        // ->leftJoin('users','user_question_answers.user_id','=','users.id')
        // ->whereRaw(
        //     '(
        //         CASE
        //             WHEN ( question_choices.point = 10 ) THEN true ELSE false
        //         END
        //     )'
        // )
        // ->where([['user_question_answers.status','=',0]])
        // ->get();

        // dd($userNeedUpdateForQuiz);

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

    public function storeQuiz(Request $request){
        $req = $request->all();
        $round = Round::where('status',1)->get();

        foreach ($req['result'] as $key => $res) {
            UserQuestionAnswers::updateOrCreate([
                'user_id'   => Auth::user()->id,
                'question_id'  => $res['id_question'],
            ],[
                'choice_id' => $res['id_choice'],
            ]);
        }

        $userNeedUpdateForQuiz = UserQuestionAnswers::select('user_question_answers.id as uqa_id','users.id','users.name','user_question_answers.status','user_question_answers.question_id','user_question_answers.choice_id','question_choices.point','question_choices.choice')
        ->leftJoin('question_choices','user_question_answers.choice_id','=','question_choices.id')
        ->leftJoin('users','user_question_answers.user_id','=','users.id')
        ->whereRaw(
            '(
                CASE
                    WHEN ( question_choices.point = 40 ) THEN true ELSE false
                END
            )'
        )
        ->where([['user_question_answers.status','=',0]])
        ->get();


        $point = 40;
        if ($round[0]->id == 1) {
            User::where([['id','=',Auth::user()->id]])
            ->increment('total_point', 20);

            User::where([['id','=',Auth::user()->id]])
            ->increment('point_1', 20);

            foreach ($userNeedUpdateForQuiz as $key => $value) {
                if ($value->status == 0) {
                    User::where([['id','=',$value->id]])
                    ->increment('total_point', 40);

                    User::where([['id','=',$value->id]])
                    ->increment('point_1', 40);
                }
            }
        }

        if ($round[0]->id == 2) {
            User::where([['id','=',Auth::user()->id]])
            ->increment('total_point', 20);

            User::where([['id','=',Auth::user()->id]])
            ->increment('point_2', 20);
            foreach ($userNeedUpdateForQuiz as $key => $value) {
                if ($value->status == 0) {
                    User::where([['id','=',$value->id]])
                    ->increment('total_point', 40);

                    User::where([['id','=',$value->id]])
                    ->increment('point_2', 40);
                }
            }
        }

        if ($round[0]->id == 3) {
            User::where([['id','=',Auth::user()->id]])
            ->increment('total_point', 20);

            User::where([['id','=',Auth::user()->id]])
            ->increment('point_3', 20);
            foreach ($userNeedUpdateForQuiz as $key => $value) {
                if ($value->status == 0) {
                    User::where([['id','=',$value->id]])
                    ->increment('total_point', 40);

                    User::where([['id','=',$value->id]])
                    ->increment('point_3', 40);
                }
            }
        }

        if ($round[0]->id == 4) {
            User::where([['id','=',Auth::user()->id]])
            ->increment('total_point', 20);

            User::where([['id','=',Auth::user()->id]])
            ->increment('point_4', 20);
            foreach ($userNeedUpdateForQuiz as $key => $value) {
                if ($value->status == 0) {
                    User::where([['id','=',$value->id]])
                    ->increment('total_point', 40);

                    User::where([['id','=',$value->id]])
                    ->increment('point_4', 40);
                }
            }
        }

        foreach ($userNeedUpdateForQuiz as $key => $value) {
            if ($value->status == 0) {
                UserQuestionAnswers::where([['id','=',$value->uqa_id]])
                ->update(['status'=>1,'is_right'=>1]);
            }
        }

        $currentRound = $round[0]->id;
        QuizIndicator::updateOrCreate([
            'id_user'   => Auth::user()->id,
        ],[
            'quiz_'.$currentRound => 1,
        ]);

        return response()->json([
            'code' => '200',
            'message' => 'success',
            'totalTrue' => count($userNeedUpdateForQuiz),
            'quiz' => true
        ],200);

    }

    public function getQuiz()
    {
        $round = Round::where('status',1)->get();

        $soal = Questions::where('rounds_id',$round[0]->id)->inRandomOrder()->get();
        $option =  QuestionChoices::select('choice', 'id', 'question_id')->get();


        return response()->json(array('question'=>$soal,'option'=>$option));
    }

    public function selectCity($id)
    {
        $regencies = Regencie::where('province_id', $id)->get();
        return response()->json($regencies);
    }

    public function storeRegister(Request $request)
    {

        $data = $request->all();
        $check = $this->createUser($data);

    }

    public function createUser(Request $request)
    {

        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|min:3|unique:users,username|alpha_dash',
            'provinsi' => 'required',
            'city' => 'required',
            'address' => 'required|min:10',
            'phone' => 'required|min:10',
            'size_jersey' => 'required|string',
            'size_sepatu' => 'required|numeric',
            'nik' => 'required|min:16|unique:users,nik',
         ]);



        DB::beginTransaction();

        try {
            $data = $request->all();

            $createUser = User::create([
                'name' => $data['name'],
                'username' => $data['username'],
                'account_instagram' => $data['account_instagram'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'nik' => $data['nik'],
                'kota' => $data['provinsi'],
                'kecamatan' => $data['city'],
                'address' => $data['address'],
                'size_jersey' => $data['size_jersey'],
                'size_sepatu' => $data['size_sepatu'],
                'role' => 0,
                'point_1'=> 60,
                'total_point' => 60,
                'password' => Hash::make($data['password']),
              ]);

              $userLastId = $createUser->id;

              $matches = Fmatch::join('countries as c1', 'fmatches.id_team_a', '=', 'c1.id')
                ->join('countries as c2', 'fmatches.id_team_b', '=', 'c2.id')
                ->join('rounds as c3', 'fmatches.round', '=', 'c3.id')
                ->select("fmatches.id","c1.name AS team1", "c2.name AS team2","score_a","score_b","stadium","match_time","expired_time","c3.title as round","c1.flag_image as flag_team1","c2.flag_image as flag_team2","match_status")
                ->get();

                foreach ($matches as $key => $match) {
                    Guessing::updateOrCreate([
                        'id_user'   => $userLastId,
                        'id_match'  => $match->id,
                    ],[
                        'guessing_score_a' => 0,
                        'guessing_score_b' => 0,
                    ]);
                }

                return redirect()->intended('/masuk');

        } catch (\Throwable $e) {
            // Session::flash('email_duplicate', 'Email sudah terpakai');
            return redirect()->intended('/daftar');
        }
    }

    public function lupapassword(){
        return view('web.pages.forgot_password');
    }

    public function klasemen($offset,$putaran){
        $cr;
        switch ($putaran) {
            case 5:
                $cr = 'total_point';
                break;
            case 1:
                $cr = 'point_1';
                break;
            case 2:
                $cr = 'point_2';
                break;
            case 3:
                $cr = 'point_3';
                break;
            case 4:
                $cr = 'point_4';
                break;
            default:
                # code...
                break;
        }

        $klasemens = User::where('role' , 0)->skip($offset)
        ->take(16)
        ->orderBy($cr,'DESC')
        ->orderBy('name','ASC')
        ->get();

        return response()->json([
            'code' => '200',
            'data' => $klasemens
        ],200);

    }

    //public function showResetPasswordForm($token) {
    public function showResetPasswordForm() {
        //return view('auth.forgetPasswordLink', ['token' => $token]);
        return view('web.pages.reset_password');
     }

}

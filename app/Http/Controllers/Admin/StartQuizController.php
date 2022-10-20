<?php

namespace App\Http\Controllers\Admin; 
use App\Http\Controllers\Controller; 

use App\Models\Questions;
use App\Models\QuestionChoices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Alert;

class StartQuizController extends Controller
{
    public function index()
    {
        
        return view('admin.quizs.pages');
    }

    public function getquiz()
    {
    
        // $questions = Questions::select('question_id','question')->with('choices' => function($query){
        //     $query->inRandomOrder();
        // }])->inRandomOrder()->get()->toJson(JSON_PRETTY_PRINT);
    // if(is_null($questions)){
    //     return response()->json('Record not found!', 401);
    // }
//     return response(['message'=>"Questions displayed successfully", 
//    'quizQuestions'=>$questions],200);

    //$questions = Questions::select('question_id','question')->with('choices')->get()->toJson(JSON_PRETTY_PRINT);
    // }])->inRandomOrder()->get()->toJson(JSON_PRETTY_PRINT);

    $questions = Questions::with(['choices'=>function($query){
        $query->get('choice_id','question_id');
    }])->select('question_id', 'question')->inRandomOrder()->get()->toJson(JSON_PRETTY_PRINT);

        dd($questions);
        //return response()->json_encode(['questions'=>$questions],200);

        //return view('admin.quizs.pages', compact(['questions']))->render();
        
        //return $questions->toJson(JSON_PRETTY_PRINT);
    }


}

<?php

namespace App\Http\Controllers\Admin; 
use App\Http\Controllers\Controller; 

use App\Models\Questions;
use App\Models\Round;
use App\Models\QuestionChoices;
use App\Models\QuizCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Alert;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $datas = Questions::with('round_match')->get();
        return view('admin.quizs.index',compact('datas'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.quizs.create',[
            'rounds' => Round::all(),
            'category' => QuizCategory::all(),
            'statuses' => $this->statuses(),
        ]);
        //return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'question' => 'required|string|max:100',
                
            ]
        );

        if ($validator->fails()){
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }
        // proses insert

        DB::beginTransaction();
        try {
            $post = Questions::create([
                'question' => $request->question,
                'question_id' => QuestionChoices::create([
                    "question" => $request->question
                  ])->id,
                  'catquiz_id' => $request->catquiz,
                  'rounds_id' => $request->round,
                  'status' => $request->status,  
                'user_id' => Auth::user()->id,
            ]);

            Alert::success('Tambah Qestion Berhasil', 'Berhasil');
            return redirect()->route('quizs.index');
        } catch (\throwable $th){
            DB::rollBack(); 
            Alert::error('Tambah Question', 'error'.$th->getMessage());
            return redirect()->back()->withInput($request->all());
        } finally{
            DB::commit();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
        //dd($post);

        $images = PostImages::orderBy('order', 'ASC')->where('post_id', $post->id)->get();
        //dd($images);
        return view('admin.posts.detail',compact('images'),compact('post'));

    }

    public function details($id)
    {
           

        $posts = Post::join('category_post', 'posts.id', '=', 'category_post.post_id')
                ->where('category_post.category_id','=', $id)
               ->get(['posts.*']);
        return view('admin.posts.index',compact('posts'));
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        
        $datas = array(
            'question' => Questions::find($id),
            'status' => $this->statuses(),
            'rounds' => Round::all(),
            'category' => QuizCategory::all(),
            'options' =>  Questions::with(['choices'])->where('id',$id)->get(),
        );

        //$options =  Questions::with(['choices'])->where('id',$id)->get();
        //dd($options);

        // $question = Questions::with(['choices'])->where('id',$id)->get();
        // dd($question);
        //$question =  Questions::with('choices')->get();
        //dd($options);

        return view('admin.quizs.edit')->with($datas);   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
      
        $question = Questions::find($id);
        $question->question= $request->input('question');
        $question->catquiz_id= $request->input('catquiz');
        $question->rounds_id= $request->input('round');
        $question->status= $request->input('status');

        $question->save();
        Alert::success('Update Question', 'Berhasil');
        return redirect()->route('quizs.index');

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $question = Questions::findOrFail($id);
            $question->delete();
            Alert::success('Delete Quetsion', 'Berhasil');
        } catch (\throwable $th){
            Alert::error('Delete Quetsion', 'error'.$th->getMessage()); 
        }
        return redirect()->back();
    }

    private function statuses(){

        return [
            '1' => 'active',
            '0' => 'non-active',
        ];
    }
}

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


class QuestionChoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('admin.quizchoices.create',[
            'quiz' =>Questions::all(),
         
        ]);
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
        //dd($request);
        $validator = Validator::make(
            $request->all(),
            [
                'question_id' => 'required',
                'choice' => 'required',
                'point' => 'required',    
            ]
        );

        if ($validator->fails()){
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }
        // proses insert

        DB::beginTransaction();
        try {
            $post = QuestionChoices::create([
                'question_id' => $request->question_id,
                'choice' => $request->choice,
                'point' => $request->point,
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

        $questionChoice = QuestionChoices::find($id);
        $questionChoice->choice= $request->input('choice');
        $questionChoice->point= $request->input('point');
        $questionChoice->save();
        Alert::success('Update Question', 'Berhasil');
        return redirect()->back();
        


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
}

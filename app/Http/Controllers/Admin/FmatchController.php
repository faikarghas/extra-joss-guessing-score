<?php

namespace App\Http\Controllers\Admin; 
use App\Http\Controllers\Controller; 

use App\Models\Countries;
use App\Models\Round;
use App\Models\Fmatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Alert;

class FmatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Fmatch::with('countries_one', 'countries_two', 'round_match')->get();
        //dd($datas);
        return view('admin.match.index',compact('datas'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.match.create',[
            'country' => Countries::all(),
            'round' => Round::all(),            
            'match_status' => $this->match_status()
    
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
       
        $validator = Validator::make(
            $request->all(),
            [
                'id_team_a' => 'required',
                'id_team_b' => 'required',
                'match_time' => 'required',
            ]
        );

        if ($validator->fails()){
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }
        // proses insert

        DB::beginTransaction();
        try {
            $fmatch = Fmatch::create([
                'id_team_a' => $request->id_team_a,
                'id_team_b' => $request->id_team_b,
                'match_time' => $request->match_time,
                'score_a' =>$request->score_a,
                'score_b' =>$request->score_b,
                'match_status' => $request->match_status,
                'round' => $request->round,
                'user_id' => Auth::user()->id,
                
            ]);
            Alert::success('Tambah Matchs', 'Berhasil');
            return redirect()->route('matchs.index');
        } catch (\throwable $th){
            DB::rollBack(); 
            Alert::error('Tambah Matchs', 'error'.$th->getMessage());
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
            'fmatch' => Fmatch::find($id),
            'round' => Round::all(),
            'country' => Countries::all(),
            'match_status' => $this->match_status(),
            
        );


        return view('admin.match.edit')->with($datas);     
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        //dd($request->thumbnail);


        $validator = Validator::make(
            $request->all(),
            [
                'id_team_a' => 'required',
                
            ]
        );
        if ($validator->fails()){
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        $fmatch = Fmatch::find($id);
        $fmatch->id_team_a= $request->input('id_team_a');
        $fmatch->id_team_b= $request->input('id_team_b');
        $fmatch->score_a= $request->input('score_a');
        $fmatch->score_b= $request->input('score_b');
        $fmatch->match_time= $request->input('match_time');
        $fmatch->round= $request->input('round');
        $fmatch->match_status= $request->input('match_status');
        
        
        $fmatch->save();
        Alert::success('Update Teams', 'Berhasil');
        return redirect()->route('matchs.index');

    }
    
    public function destroy(Post $post)
    {
        try {
            $post->delete();
            Alert::success('Delete Post', 'Berhasil');
        } catch (\throwable $th){
            Alert::error('Delete Post', 'error'.$th->getMessage()); 
        }
        return redirect()->back();
    }

    private function match_status(){

        return [
            'OPEN' => 'OPEN',
            'CLOSE' => 'CLOSE',git
        ];
    }

    public function update_status(Request $request, $id){


        $fmatch = Fmatch::find($id);
        $fmatch->status= $request->input('status');
        $fmatch->save();

        Alert::success('Update Status', 'Berhasil');
        return redirect()->route('matchs.index');


    }
}

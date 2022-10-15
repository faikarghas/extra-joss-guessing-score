<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Alert;

class CareerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $careers = Career::all();
        return view('admin.careers.index',compact('careers'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.careers.create',[
            //'categories' => Category::with('descendants')->onlyParent()->get(),
            'statuses' => $this->statuses(),
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
                'title' => 'required|string|max:100',
                'slug' => 'required|string|unique:posts,slug',
                'departement' => 'required|string',
                'location' => 'required',
                'type' => 'required',
                'description' => 'required|string'
            ]
        );

        if ($validator->fails()){
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }
        // proses insert

        DB::beginTransaction();
        try {
            $post = Career::create([
                'title' => $request->title,
                'slug' => $request->slug,
                'type' => $request->type,
                'thumbnail' => $request->thumbnail,
                'description' => $request->description,
                'departement' => $request->departement,
                'location' => $request->location,
                'status' => $request->status,
                'user_id' => Auth::user()->id
            ]);

            Alert::success('Tambah Career', 'Berhasil');
            return redirect()->route('careers.index');
        } catch (\throwable $th){
            DB::rollBack(); 
            Alert::error('Tambah Career', 'error'.$th->getMessage());
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

        //$images = PostImages::orderBy('order', 'ASC')->where('post_id', $post->id)->get();
        //dd($images);
        return view('admin.careers.detail',compact('post'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Career $career)
    {
        //
        return view('admin.careers.edit',[
            'career' => $career,
            'statuses' => $this->statuses(),
        ]);
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Career $career)
    {
        //
        //dd($request->thumbnail);


        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|string|max:100',
                'slug' => 'required|string|unique:careers,slug,'. $career->id,
                'description' => 'required|string',
                'location' => 'required|string',
                'type' => 'required|string',
                'status' => 'required'
            ]
        );
        if ($validator->fails()){
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        DB::beginTransaction();

        try {
            $career->update([
                'title' => $request->title,
                'slug' => $request->slug,
                'thumbnail' => parse_url($request->thumbnail)['path'],
                'departement' => $request->departement,
                'description' => $request->description,
                'location' => $request->location,
                'type' => $request->type,
                'status' => $request->status,
                'user_id' => Auth::user()->id
            ]);
            Alert::success('Update Career', 'Berhasil');
            return redirect()->route('careers.index');
        } catch (\throwable $th){
            DB::rollBack(); 
            Alert::error('Tambah career', 'error'.$th->getMessage());
            return redirect()->back()->withInput($request->all());
        } finally{
            DB::commit();
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Career $career)
    {
        try {
            $career->delete();
            Alert::success('Delete Post', 'Berhasil');
        } catch (\throwable $th){
            Alert::error('Delete Career', 'error'.$th->getMessage()); 
        }
        return redirect()->back();
    }

    private function statuses(){

        return [
            'draft' => 'draft',
            'publish' => 'publish',
        ];
    }
}

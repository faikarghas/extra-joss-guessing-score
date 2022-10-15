<?php

namespace App\Http\Controllers\Admin; 
use App\Http\Controllers\Controller; 


use App\Models\Post;
use App\Models\PostImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Alert;

class PostImagesController extends Controller
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        //dd($request->all());
        //
        $validator = Validator::make(
            $request->all(),
            [
                'images' => 'required',
                'title' => 'required',
                'order' => 'required|numeric'
            ]
        );
        if ($validator->fails()){
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }
        try {
            $images = $request->images;
            $image = explode(",", $images);
            if (!empty($image)){
                foreach ($image as $value ){
                    $dirname = pathinfo($value)['dirname'];
                    PostImages::create([
                        'title'=>$request->title,
                        'order'=>$request->order,
                        'images' => basename($value),
                        'path' => parse_url($dirname)['path'],
                        'full_path' => $value,
                        'post_id'=>$request->post_id
                    ]);
                }       
            }
            Alert::success('Tambah Kategori', 'Berhasil');
            return redirect()->back();
        } catch (\throwable $th){
            Alert::error('Tambah Kategori', 'error'.$th->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PostImages  $postImages
     * @return \Illuminate\Http\Response
     */
    public function show(PostImages $postImages)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PostImages  $postImages
     * @return \Illuminate\Http\Response
     */
    public function edit(PostImages $postImages)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PostImages  $postImages
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //

        $images = $request->images;
        $dirname = pathinfo($images)['dirname'];
        try {
            $images_update = PostImages::where("id",$request->id)->update([
                'images' => basename($images),
                'path' => parse_url($dirname)['path'],
                'full_path' =>$request->images,
                'title'=>$request->title,
                'order'=>$request->order
            ]);
            Alert::success('Update Kategori', 'Berhasil');
            return redirect()->back();
        } catch (\throwable $th){
            
            Alert::error('Tambah Kategori', 'error'.$th->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PostImages  $postImages
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        //dd($id);
        
        try {
            //$postImages->delete();
            $res=PostImages::find($id)->delete();
            Alert::success('Delete Post', 'Berhasil');
        } catch (\throwable $th){
            Alert::error('Delete Post', 'error'.$th->getMessage()); 
        }
        return redirect()->back();
    }
}

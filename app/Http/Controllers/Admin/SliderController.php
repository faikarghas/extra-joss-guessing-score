<?php

namespace App\Http\Controllers\Admin; 
use App\Http\Controllers\Controller; 


use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Alert;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slider = Slider::all();
        return view('admin.sliders.index',compact('slider'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sliders.create',[
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
       

        //$images = $request->images;
        //$image = explode(",", $images);
        // if (!empty($image)){
        //     dd('data tidak kosong');
        // }
        // 
        //dd($image);

        //dd($image[0],parse_url($image[0])['path']);
        // get filename
        //dd(basename($image[0]));
        // get path 
        //dd(pathinfo($image[0])['dirname']);
        //dd(pathinfo($image[0]));
        // get path without host
        //$dirname = pathinfo($image[0])['dirname'];
        //dd($dirname);
        //get path without host
        //dd(parse_url($dirname)['path']);
        //$host = request()->getHttpHost(); 
        //dd(parse_url($image[0])['host']);


        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|string|max:100',
                'status' => 'required'
            ]
        );

        if ($validator->fails()){
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        // // proses insert
        // if($request->file('images_desktop')){
        //     $file= $request->file('images_desktop');
        //     $filename= date('YmdHi').$file->getClientOriginalName();
        // } else {
        //     $filename="";
        // }

        $imageDesktop = $request->image_desktop;
        $uri_segments = explode('/', $imageDesktop);
        $filename = end($uri_segments);

        $imageMobile = $request->image_mobile;
        $uri_segments2 = explode('/', $imageMobile);
        $filename2 = end($uri_segments2);
        
        
        DB::beginTransaction();
        try {
            $data = Slider::create([
                'title' => $request->title,
                'image_desktop' => $filename,
                'image_desktop_path' =>$request->image_desktop,
                'image_mobile' => $filename2,
                'image_mobile_path' =>$request->image_mobile,
                'desc' => $request->description,
                'status' => $request->status,
                'user_id' => Auth::user()->id,
            ]);

            // $images = $request->images;
            // $image = explode(",", $images);

            // $images = $request->images;
            // $imagess = explode(",", $images);
            // $imagesss = array_filter($imagess);

            // if (!empty($imagesss)){
            //     foreach ($imagesss as $value ){
            //         $dirname = pathinfo($value)['dirname'];
            //         PostImages::create([
            //             'images' => basename($value),
            //             'path' => parse_url($dirname)['path'],
            //             'full_path' => $value,
            //             'post_id'=>$post->id
            //         ]);
            //     }       
            // }

            Alert::success('Tambah Post', 'Berhasil');
            return redirect()->route('sliders.index');
        } catch (\throwable $th){
            DB::rollBack(); 
            Alert::error('Tambah Slider', 'error'.$th->getMessage());
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
    public function show(Slider $slider)
    {
        //
        //dd($post);

        //$post = Post::orderBy('order', 'ASC')->where('post_id',)->get();
        
        //return view('admin.slider.detail',compact('post'));
        return view('admin.slider.detail');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        //
        return view('admin.sliders.edit',[
            'slider' => $slider,
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
    public function update(Request $request, Slider $slider)
    {
        //
        //dd($request->thumbnail);
        $uri_segments = explode('/', $request->image_desktop);
        $filename = end($uri_segments);
        $uri_segments2 = explode('/', $request->image_mobile);
        $filename2 = end($uri_segments2);

        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|string|max:100',
                'status' => 'required'
            ]
        );
        if ($validator->fails()){
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        DB::beginTransaction();

        try {
            $slider->update([
                'title' => $request->title,
                'image_desktop' => $filename,
                'image_desktop_path' =>$request->image_desktop,
                'image_mobile' =>$filename2,
                'image_mobile_path' =>$request->image_mobile,
                'desc' => $request->description,
                'status' => $request->status,
                'user_id' => Auth::user()->id,
            ]);
            Alert::success('Update Banner', 'Berhasil');
            return redirect()->route('sliders.index');
        } catch (\throwable $th){
            DB::rollBack(); 
            Alert::error('Tambah Slider', 'error'.$th->getMessage());
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
    public function destroy(Slider $slider)
    {
        try {
            $slider->delete();
            Alert::success('Delete Slider', 'Berhasil');
        } catch (\throwable $th){
            Alert::error('Delete Slider', 'error'.$th->getMessage()); 
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

<?php

namespace App\Http\Controllers\Admin; 
use App\Http\Controllers\Controller; 

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $datas = User::all();
        return view('admin.users.index',compact('datas'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.posts.create',[
            'categories' => Category::with('descendants')->onlyParent()->get(),
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
                'title' => 'required|string|max:100',
                'slug' => 'required|string|unique:posts,slug',
                'content' => 'required|string',
                'category' => 'required',
                'status' => 'required'
            ]
        );

        if ($validator->fails()){
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }
        // proses insert

        DB::beginTransaction();
        try {
            $post = Post::create([
                'title' => $request->title,
                'subtitle' => $request->subtitle,
                'slug' => $request->slug,
                'thumbnail' =>$request->thumbnail,
                'image' => $request->image,
                'description' => $request->description,
                'content' => $request->content,
                'status' => $request->status,
                'category' => $request->category,
                'user_id' => Auth::user()->id,
            ]);

            $post->categories()->attach($request->category);

            $images = $request->images;
            $image = explode(",", $images);

            $images = $request->images;
            $imagess = explode(",", $images);
            $imagesss = array_filter($imagess);


            if (!empty($imagesss)){
                foreach ($imagesss as $value ){
                    $dirname = pathinfo($value)['dirname'];
                    PostImages::create([
                        'images' => basename($value),
                        'path' => parse_url($dirname)['path'],
                        'full_path' => $value,
                        'post_id'=>$post->id
                    ]);
                }       
            }
            Alert::success('Tambah Post', 'Berhasil');
            return redirect()->route('posts.index');
        } catch (\throwable $th){
            DB::rollBack(); 
            Alert::error('Tambah Post', 'error'.$th->getMessage());
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

    public function edit($id)
    {
        
       

        $datas = array(
            'user' => User::find($id)
        );
        return view('admin.users.edit')->with($datas); 

        // return view('admin.users.edit',[
        //        'user' => User::find($id),
        //     // 'categories' => Category::with('descendants')->onlyParent()->get(),
        //     // 'statuses' => $this->statuses(),
        // ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
        //dd($request->thumbnail);


        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|string|max:100',
                'slug' => 'required|string|unique:posts,slug,'. $post->id,
                'content' => 'required|string',
                'category' => 'required',
                'status' => 'required'
            ]
        );
        if ($validator->fails()){
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        DB::beginTransaction();
        
        $now = date('Y-m-d H:i'); //Fomat Date and time //you are overwriting this variable below
        $now = $request->publishDate; //should be course_date
        
        try {
            $post->update([
                'title' => $request->title,
                 'subtitle' => $request->subtitle,
                'slug' => $request->slug,
                //'thumbnail' => parse_url($request->thumbnail)['path'],
                'thumbnail' => $request->thumbnail,
              'image' => $request->image,
                'description' => $request->description,
                'content' => $request->content,
                'status' => $request->status,
                'category' => $request->category,
                'publish_date' => $now,
                'user_id' => Auth::user()->id,
            ]);
            $post->categories()->sync($request->category);
            Alert::success('Update Post', 'Berhasil');
            //return redirect()->route('posts.index');
            return redirect()->back();
        } catch (\throwable $th){
            DB::rollBack(); 
            Alert::error('Tambah Post', 'error'.$th->getMessage());
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

    private function statuses(){

        return [
            'draft' => 'draft',
            'publish' => 'publish',
        ];
    }
}

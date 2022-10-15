<?php

namespace App\Http\Controllers\Admin; 
use App\Http\Controllers\Controller; 


use App\Models\Category;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Validator;
use Alert;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $categories = Category::onlyParent()->with('descendants')->get();
        return view('admin.categories.index',compact('categories'));
    }

    public function select(Request $request)
    {
        $categories = [];
        if ($request->has('q')) {
            $search = $request->q;
            $categories = Category::select('id', 'title')->where('title', 'LIKE', "%$search%")->limit(6)->get();
        } else {
            $categories = Category::select('id', 'title')->onlyParent()->limit(6)->get();
        }
        return response()->json($categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::onlyParent()->with('descendants')->get();
        return view('admin.categories.create',compact('categories'));
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
                'slug' => 'required|string|unique:categories,slug',
                // 'thumbnail' => 'required',
                'description' => 'required|string'
            ]
        );

        if ($validator->fails()){

            if ($request->has('parent_category')){
                $request['parent_category']=Category::select('id','title')->find($request->parent_category);
            }
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }
        // proses insert
        try {
            Category::create([
                'title' => $request->title,
                'subtitle' => $request->subtitle,
                'slug' => $request->slug,
                'thumbnail' => $request->thumbnail,
                'description' => $request->description,
                'parent_id' => $request->parent_category,
            ]);
            Alert::success('Tambah Kategori', 'Berhasil');
            return redirect()->route('categories.index');
        } catch (\throwable $th){
            if ($request->has('parent_category')) {
                $request['parent_category'] = Category::select('id','title')->find($request->parent_category);
            }
            Alert::error('Tambah Kategori', 'error'.$th->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {   
        return view('admin.categories.detail',compact('category'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
        //dd($category);
        return view('admin.categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|string|max:100',
                'slug' => 'required|string|unique:categories,slug,'.$category->id,
                // 'thumbnail' => 'required',
                'description' => 'required|string'
            ]
        );

        if ($validator->fails()){

            if ($request->has('parent_category')){
                $request['parent_category']=Category::select('id','title')->find($request->parent_category);
            }
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        try {
            $category->update([
                'title' => $request->title,
                'subtitle' => $request->subtitle,
                'slug' => $request->slug,
                'thumbnail' => $request->thumbnail,
                'description' => $request->description,
                'parent_id' => $request->parent_category,
            ]);
            Alert::success('Update Kategori', 'Berhasil');
            //return redirect()->route('categories.index');
            return redirect()->back()->withInput($request->all());
        } catch (\throwable $th){
            if ($request->has('parent_category')) {
                $request['parent_category'] = Category::select('id','title')->find($request->parent_category);
            }
            Alert::error('Tambah Kategori', 'error'.$th->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();
            Alert::success('Delete Kategori', 'Berhasil');
        } catch (\throwable $th){
            Alert::error('Delete Kategori', 'error'.$th->getMessage()); 
        }
        return redirect()->back();
    }
    public function detail(Category $category, $slug){
        $categories = Category::onlyParent()->with('descendants')->where('slug',$slug)->get();
        return view('admin.categories.index',compact('categories'));
    }
}

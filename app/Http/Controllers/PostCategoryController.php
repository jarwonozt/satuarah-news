<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCategoryRequest;
use App\Models\PostCategory;
use Exception;
use Illuminate\Support\Str;

class PostCategoryController extends Controller
{
    public function index()
    {
        return view('admin.posts.categories.index');
    }

    public function create()
    {
        //
    }

    public function store(PostCategoryRequest $request)
    {
        try{
            $save = new PostCategory();
            $save->name = $request->name;
            $save->slug = Str::slug($request->name);
            $save->description = $request->description;
            $save->status = 1;
            $save->created_by = auth()->user()->id;
            $save->save();

            return redirect()->route('postcategories.index')->with('message', "Kategori $save->name berhasil ditambahkan");
        }catch(Exception $error){
            return redirect()->route('postcategories.index')->with('message', $error->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PostCategory $postCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PostCategory $postCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostCategoryRequest $request, PostCategory $postCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PostCategory $postCategory)
    {
        //
    }
}

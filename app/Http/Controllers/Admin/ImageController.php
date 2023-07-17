<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\ImageCategory;
use App\Services\ImageServices;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class ImageController extends Controller
{
    public function index()
    {
        return view('admin.images.index');
    }

    public function create()
    {
        return view('admin.images.create', [
            'categories' => ImageCategory::where('status', 1)->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id'=>'required',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif|dimensions:max_width=1500,max_height:1500',
        ]);

        $image = '';
        if($request->file('image')){
            $data = [
            'file'=>$request->file('image'),
            'path'=>public_path('storage/images/'),
            'modul'=>'image'
            ];
            $upload = ImageServices::uploadImage($data);
            if($upload['status'] == true){
                $image = $upload['name'];
            }else{
                return redirect()->route('images.index')->wsith('message', 'Gagal Upload File');
            }
        }

        try{
            $save = new Image();
            $save->title = $request->title;
            $save->slug = $request->slug;
            $save->description = $request->description;
            $save->status = $request->status;
            $save->category_id = $request->category_id;
            $save->created_by = auth()->user()->id;

            if($image){
                $save->image = $image;
            }

            $save->save();

            Cache::flush("images");

            return redirect()->route('images.index')->with('message', "$save->title berhasil ditambahkan");
        }catch(Exception $error){
            return redirect()->route('images.index')->with('message', $error->getMessage());
        }
    }

    public function edit($id)
    {
        return view('admin.images.edit', [
            'data' => Image::findOrFail($id),
            'categories' => ImageCategory::where('status', 1)->get()
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'image'=>'image|mimes:jpeg,png,jpg,gif|dimensions:max_width=1500,max_height:1500',
        ]);

        $image = '';
        if($request->file('image')){
            $data = [
            'file'=>$request->file('image'),
            'path'=>public_path('storage/images/'),
            'modul'=>'image'
            ];
            $upload = ImageServices::uploadImage($data);
            if($upload['status'] == true){
                $image = $upload['name'];
            }else{
                return redirect()->route('images.index')->wsith('message', 'Gagal Upload File');
            }
        }

        try{
            $save = Image::findOrFail($id);
            $save->title = $request->title;
            $save->slug = $request->slug;
            $save->description = $request->description;
            $save->status = $request->status;
            $save->category_id = $request->category_id;
            $save->updated_by = auth()->user()->id;

            if($image){
                $save->image = $image;
            }

            $save->save();

            Cache::flush("images-$save->slug");

            return redirect()->route('images.index')->with('message', "$save->title berhasil diupdate");
        }catch(Exception $error){
            return redirect()->route('images.index')->with('message', $error->getMessage());
        }
    }
}

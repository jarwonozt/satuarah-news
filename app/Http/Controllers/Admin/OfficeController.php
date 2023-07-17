<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Office;
use App\Models\OfficeCategory;
use App\Services\ImageServices;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class OfficeController extends Controller
{
    public function index()
    {
        return view('admin.offices.index');
    }

    public function create()
    {
        return view('admin.offices.create', [
            'categories' => OfficeCategory::where('status', 1)->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|max:255|unique:offices',
            'category_id'=>'required',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif|dimensions:max_width=1500,max_height:1500',
        ]);

        $image = '';
        if($request->file('image')){
            $data = [
            'file'=>$request->file('image'),
            'path'=>public_path('storage/offices/'),
            'modul'=>'image'
            ];
            $upload = ImageServices::uploadImage($data);
            if($upload['status'] == true){
                $image = $upload['name'];
            }else{
                return redirect()->route('offices.index')->wsith('message', 'Gagal Upload File');
            }
        }

        try{
            $save = new Office();
            $save->title = $request->title;
            $save->slug = Str::slug($request->title);
            $save->description = $request->description;
            $save->website = $request->website;
            $save->content = $request->content;
            $save->information = $request->information;
            $save->status = $request->status;
            $save->category_id = $request->category_id;
            $save->created_by = auth()->user()->id;

            if($image){
                $save->image = $image;
            }

            $save->save();


            Cache::flush("offices-$save->category_id");

            return redirect()->route('offices.index')->with('message', "$save->title berhasil ditambahkan");
        }catch(Exception $error){
            return redirect()->route('offices.index')->with('message', $error->getMessage());
        }
    }

    public function edit($id)
    {
        return view('admin.offices.edit', [
            'data' => Office::findOrFail($id),
            'categories' => OfficeCategory::where('status', 1)->get()
        ]);
    }

    public function update(Request $request, $id)
    {
        $image = '';
        if($request->file('image')){
            $data = [
            'file'=>$request->file('image'),
            'path'=>public_path('storage/offices/'),
            'modul'=>'image'
            ];
            $upload = ImageServices::uploadImage($data);
            if($upload['status'] == true){
                $image = $upload['name'];
            }else{
                return redirect()->route('offices.index')->wsith('message', 'Gagal Upload File');
            }
        }

        try{
            $save = Office::findOrfail($id);
            $save->title = $request->title;
            $save->slug = Str::slug($request->title);
            $save->description = $request->description;
            $save->website = $request->website;
            $save->content = $request->content;
            $save->information = $request->information;
            $save->status = $request->status;
            $save->category_id = $request->category_id;
            $save->updated_by = auth()->user()->id;

            if($image){
                $save->image = $image;
            }

            $save->save();


            Cache::flush("offices-$save->category_id");

            return redirect()->route('offices.index')->with('message', "$save->title berhasil ditambahkan");
        }catch(Exception $error){
            return redirect()->route('offices.index')->with('message', $error->getMessage());
        }
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Services\ImageServices;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ServiceController extends Controller
{
    public function index()
    {
        return view('admin.services.index');
    }

    public function create()
    {
        return view('admin.services.create', [
            'categories' => ServiceCategory::where('status', 1)->get()
        ]);
    }

    public function store(Request $request)
    {
        $image = '';
        if($request->file('image')){
            $data = [
            'file'=>$request->file('image'),
            'path'=>public_path('storage/services/'),
            'modul'=>'image'
            ];
            $upload = ImageServices::uploadImage($data);
            if($upload['status'] == true){
                $image = $upload['name'];
            }else{
                return redirect()->route('services.index')->wsith('message', 'Gagal Upload File');
            }
        }

        try{
            $save = new Service();
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


            Cache::flush("services-$save->category_id");

            return redirect()->route('services.index')->with('message', "$save->title berhasil ditambahkan");
        }catch(Exception $error){
            return redirect()->route('services.index')->with('message', $error->getMessage());
        }
    }

    public function edit($id)
    {
        return view('admin.services.edit', [
            'data' => Service::findOrFail($id),
            'categories' => ServiceCategory::where('status', 1)->get()
        ]);
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        $image = '';
        if($request->file('image')){
            $data = [
            'file'=>$request->file('image'),
            'path'=>public_path('storage/services/'),
            'modul'=>'image'
            ];
            $upload = ImageServices::uploadImage($data);
            if($upload['status'] == true){
                $image = $upload['name'];
            }else{
                return redirect()->route('services.index')->wsith('message', 'Gagal Upload File');
            }
        }

        try{
            $save = Service::findOrFail($id);
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

            Cache::flush("services-$save->category_id");

            return redirect()->route('services.index')->with('message', "$save->title berhasil diupdate");
        }catch(Exception $error){
            return redirect()->route('services.index')->with('message', $error->getMessage());
        }
    }
}

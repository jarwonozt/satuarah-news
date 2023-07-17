<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\FileCategory;
use App\Models\FileLinkage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class FileController extends Controller
{
    public function index()
    {
        return view('admin.files.index');
    }

    public function create()
    {
        return view('admin.files.create', [
            'categories' => FileCategory::where('status', 1)->get()
        ]);
    }

    public function store(Request $request)
    {
        try{
            $save = new File();
            $save->title = $request->title;
            $save->slug = $request->slug;
            $save->name = Str::title($request->title);
            $save->description = $request->description;
            $save->status = $request->status;
            $save->category_id = $request->category_id;
            $save->created_by = auth()->user()->id;

            $save->save();

            Cache::flush("file");


            for ($i=0; $i < count($request->file); $i++) {
                $fileLinkage[$i] = FileLinkage::insert([
                    'name' => $request->file[$i]->getClientOriginalName(),
                    'type' => $request->file[$i]->getMimeType(),
                    'size' => $request->file[$i]->getSize(),
                    'file_id' => $save->id
                ]);
            }

            if($request->file)
            {
                foreach($request->file as $file)
                {
                    if(!file_exists(public_path('storage'))){
                        mkdir(public_path('storage'), 0755);
                    }

                    if(!file_exists(public_path('storage/files'))){
                        mkdir(public_path('storage/files'), 0755);
                    }

                    $name = $file->getClientOriginalName();
                    $file->move('storage/files/', $name);
                }
            }

            return redirect()->route('files.index')->with('message', "$save->title berhasil ditambahkan");
        }catch(Exception $error){
            return redirect()->route('files.index')->with('message', $error->getMessage());
        }
    }

    public function edit($id)
    {
        $data =  File::with('files')->findOrFail($id);
        // dd($data->files);
        return view('admin.files.edit', [
            'data' => File::with('files')->findOrFail($id),
            'categories' => FileCategory::where('status', 1)->get()
        ]);
    }

    public function update(Request $request, $id)
    {
        try{
            $save = File::findOrFail($id);
            $save->title = $request->title;
            $save->slug = $request->slug;
            $save->name = Str::title($request->title);
            $save->description = $request->description;
            $save->status = $request->status;
            $save->category_id = $request->category_id;
            $save->created_by = auth()->user()->id;
            $save->save();

            Cache::flush("file-$save->slug");


            if(empty($request->files))
            {
                for ($i=0; $i < count($request->file); $i++) {
                    $fileLinkage[$i] = FileLinkage::insert([
                        'name' => $request->file[$i]->getClientOriginalName(),
                        'type' => $request->file[$i]->getMimeType(),
                        'size' => $request->file[$i]->getSize(),
                        'file_id' => $save->id
                    ]);
                }

                foreach($request->file as $file)
                {
                    $name = $file->getClientOriginalName();
                    $file->move('storage/files/', $name);
                }
            }

            return redirect()->route('files.index')->with('message', "$save->title berhasil ditambahkan");
        }catch(Exception $error){
            return redirect()->route('files.index')->with('message', $error->getMessage());
        }
    }


    public function deleteFile($id)
    {
        FileLinkage::find($id)->delete();

        return back()->withInput();
    }
}

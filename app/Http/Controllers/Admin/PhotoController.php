<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use App\Models\PhotoLinkage;
use App\Models\Photos;
use App\Models\User;
use App\Models\Point;
use App\Services\ImageServices;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use RealRashid\SweetAlert\Facades\Alert;

class PhotoController extends Controller
{

    public function index()
    {
        return view('admin.photos.index');
    }

    public function create()
    {
        $user = auth()->user();

        foreach(config('app.user_type') as $k=>$v){
            if($user->getRoleNames()[0] == 'author'){
                $row_author = User::where('id', $user->id)->orderBy('name','asc')->get();
            }else{
                $row_author = User::where('status', 1)->orderBy('name','asc')->get();
            }

            $authors[$k]['name'] = $v;
            if(count($row_author) > 0){
                foreach($row_author as $a=>$b){
                    $user_type = explode(',', $b->user_type);
                    if(in_array($k, $user_type)){
                        $authors[$k]['data'][$a]['id'] = $b->id;
                        $authors[$k]['data'][$a]['name'] = $b->name;
                        $authors[$k]['data'][$a]['type'] = $b->user_type;
                    }
                }
            }
        }

        if($user->getRoleNames()[0] == 'author'){
            return view('admin.photos.create-only', ['authors'=>$authors]);
        }
        else{
            return view('admin.photos.create', ['authors'=>$authors]);
        }
    }

    public function store(Request $request)
    {
        // dd($request);
        $author = array_filter($request->author);
        $request->validate([
            'caption'=>'required',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        $image = '';
        if($request->file('image')){
            $data = [
            'file' => $request->file('image'),
            'path' => public_path('storage/photos/'),
            'modul' => 'image'
            ];
            $upload = ImageServices::uploadImage($data);
            if($upload['status'] == true){
                $image = $upload['name'];
            }else{
                Alert::error('Failed', 'Gagal upload file');
                return back();
            }
        }

        try{
            $save = new Photo();
            $save->title = $request->title;
            $save->slug = $request->slug;
            $save->caption = $request->caption;
            $save->content = $request->description;
            $save->status = $request->status;
            $save->created_by = auth()->user()->id;

            if($image){
                $save->image = $image;
            }

            $save->save();

            foreach($author as $k=>$v){
                $save_point = new Point();
                $save_point->modul = 'photo';
                $save_point->user_type = $k;
                $save_point->user_id = $v;
                $save_point->category_id = 0;
                $save_point->post_id = $save->id;
                $save_point->point = 1;
                $save_point->save();

            }


            Cache::flush("photos");

            return redirect()->route('photos.index')->with('message', "$save->title berhasil ditambahkan");
        }catch(Exception $error){
            return redirect()->route('photos.index')->with('message', $error->getMessage());
        }
    }


    public function show($id)
    {
        return view('admin.photos.detail', [
            'data' => Photo::findOrFail($id),
            'photoContent' => PhotoLinkage::where('photo_id', $id)->orderBy('created_at')->get()
        ]);
    }

    public function edit($id)
    {
        $user = auth()->user();

        foreach(config('app.user_type') as $k=>$v){
            if($user->getRoleNames()[0] == 'author'){
                $row_author = User::where('id', $user->id)->orderBy('name','asc')->get();
            }else{
                $row_author = User::where('status', 1)->orderBy('name','asc')->get();
            }

            $authors[$k]['name'] = $v;
            if(count($row_author) > 0){
                foreach($row_author as $a=>$b){
                    $user_type = explode(',', $b->user_type);
                    if(in_array($k, $user_type)){
                        $authors[$k]['data'][$a]['id'] = $b->id;
                        $authors[$k]['data'][$a]['name'] = $b->name;
                        $authors[$k]['data'][$a]['type'] = $b->user_type;
                    }
                }
                $user_point = Point::where('modul', 'photo')->where('user_type', $k)->where('post_id', $id)->first();
                if($user_point){
                    $authors[$k]['id'] = $user_point->user_id;
                }else {
                    $authors[$k]['id'] = '';
                }
            }
        }
        // dd(Photo::findOrFail($id));
        return view('admin.photos.edit', [
            'data' => Photo::findOrFail($id),
            'authors' => $authors
        ]);
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        $author = array_filter($request->author);
        $request->validate([
            'image'=>'image|mimes:jpeg,png,jpg,gif',
        ]);

        if($request->image != null){
            $image = '';
            if($request->file('image')){
                $data = [
                'file'=>$request->file('image'),
                'path'=>public_path('storage/photos/'),
                'modul'=>'image'
                ];
                $upload = ImageServices::uploadImage($data);
                if($upload['status'] == true){
                    $image = $upload['name'];
                }else{
                    Alert::error('Failed', 'Gagal upload file');
                    return back();
                }
            }
        }

        try{
            $save = Photo::findOrFail($id);
            $save->title = $request->title;
            $save->slug = $request->slug;
            $save->caption = $request->caption;
            $save->content = $request->description;
            $save->updated_by = auth()->user()->id;
            $save->status = $request->status;

            if($request->image != null){
                $save->image = $image;
            }

            $save->save();

            $points = Point::where('modul', 'photo')->where('post_id', $id)->count();
            if($points > 0){
                Point::where('modul', 'photo')->where('post_id', $id)->delete();
            }

            foreach($author as $k=>$v){
                $save_point = new Point();
                $save_point->modul = 'photo';
                $save_point->user_type = $k;
                $save_point->user_id = $v;
                $save_point->category_id = 0;
                $save_point->post_id = $id;
                $save_point->point = 1;
                $save_point->save();
            }

            Cache::flush("photos-$request->slug");

            return redirect()->route('photos.index')->with('message', "$save->title berhasil diupdate");
        }catch(Exception $error){
            return redirect()->route('photos.index')->with('message', $error->getMessage());
        }
    }

    public function destroy($id)
    {
        //
    }
}

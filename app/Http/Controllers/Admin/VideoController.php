<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Point;
use App\Models\PointSetting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Video;
use App\Models\VideoCategory;
use App\Models\VideoLinkage;
use Exception;
use Illuminate\Support\Facades\Cache;

class VideoController extends Controller
{
    public function index()
    {
        return view('admin.videos.index');
    }

    public function create()
    {
        $user = auth()->user();
        foreach(config('app.user_type') as $k=>$v){
            if($user->getRoleNames()[0] == 'author'){
                $row_author = User::where('status', 1)->where('id', $user->id)->get();
            }elseif($user->getRoleNames()[0] == 'admin'){
                $row_author = User::where('status', 1)->where('id', $user->id)->get();
            }
             else{
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

        return view('admin.videos.create', [
            'authors'=>$authors,
            'categories' => VideoCategory::where('status', 1)->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'published_at'=>'required',
        ]);

        $author = array_filter($request->author);
        try{
            $save = new Video();
            $save->code = Str::random(5);
            $save->youtube_id = $request->youtube_id;
            $save->title = $request->title;
            $save->slug = Str::slug($request->slug);
            $save->published_at = $request->published_at;
            $save->content = $request->content;
            $save->tags = $request->tags;
            $save->status = $request->status;
            $save->category_id = $request->category_id;
            $save->created_by = auth()->user()->id;
            $save->save();

            Cache::flush("videos");

            foreach($author as $k=>$v){
                $point = PointSetting::where('modul','video')
                        ->where('user_type', $k)
                        ->first();
                if($point){
                    $save_point = new Point();
                    $save_point->modul = 'video';
                    $save_point->user_type = $k;
                    $save_point->user_id = $v;
                    $save_point->category_id = 0;
                    $save_point->post_id = $save->id;
                    $save_point->point = $point->point;
                    $save_point->save();
                }
            }

            $tags = htmlentities(str_replace(' ','',trim($request->tags)));
            $linkages = Video::where('status', 1)->where('id','<>',$save->id)->where('tags','RLIKE',$tags)->orderBy('published_at','desc')->take(6)->get();
            if(count($linkages) > 0){
                foreach($linkages as $k=>$v){
                    $save_linkage = new VideoLinkage();
                    $save_linkage->parent_id = $save->id;
                    $save_linkage->child_id = $v->post_id;
                    $save_linkage->save();
                }
            }

            return redirect()->route('videos.index')->with('message', $save->title.' | Berhasil ditambahkan!');
        }catch(Exception $error){
            return redirect()->route('videos.index')->with('message', $error->getMessage());
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $user = auth()->user();
        foreach(config('app.user_type') as $k=>$v){
            if($user->getRoleNames()[0] == 'author'){
                $row_author = User::where('status', 1)->where('id', $user->id)->get();
            }elseif($user->getRoleNames()[0] == 'admin'){
                $row_author = User::where('status', 1)->where('id', $user->id)->get();
            }
             else{
                $row_author = User::where('status', 1)->orderBy('name','asc')->get();
            }
            $authors[$k]['name'] = $v;
            if($row_author){
                foreach($row_author as $a=>$b){
                    $user_type = explode(',', $b->user_type);
                    if(in_array($k, $user_type)){
                        $authors[$k]['data'][$a]['id'] = $b->id;
                        $authors[$k]['data'][$a]['name'] = $b->name;
                        $authors[$k]['data'][$a]['type'] = $b->user_type;
                    }
                }
                $user_point = Point::where('modul', 'video')->where('user_type', $k)->where('post_id', $id)->first();
                if($user_point){
                    $authors[$k]['id'] = $user_point->user_id;
                }else {
                    $authors[$k]['id'] = '';
                }
            }
        }

        return view('admin.videos.edit',[
            'data'=> Video::findOrFail($id),
            'authors'=> $authors,
            'categories' => VideoCategory::where('status', 1)->get()
        ]);
    }

    public function update(Request $request, $id)
    {
        $author = array_filter($request->author);
        try{
            $save = Video::findOrFail($id);
            $save->code = Str::random(5);
            $save->youtube_id = $request->youtube_id;
            $save->title = $request->title;
            $save->slug = Str::slug($request->slug);
            $save->published_at = $request->published_at;
            $save->content = $request->content;
            $save->tags = $request->tags;
            $save->status = $request->status;
            $save->category_id = $request->category_id;
            $save->updated_by = auth()->user()->id;
            $save->save();

            Cache::flush("videos-$save->slug");

            $points = Point::where('modul', 'video')->where('post_id', $id)->count();
            if($points > 0){
                Point::where('modul', 'video')->where('post_id', $id)->delete();
            }

            foreach($author as $k=>$v){
                $point = PointSetting::where('modul','video')
                        ->where('user_type', $k)
                        ->first();
                if($point){
                    $save_point = new Point();
                    $save_point->modul = 'video';
                    $save_point->user_type = $k;
                    $save_point->user_id = $v;
                    $save_point->category_id = 0;
                    $save_point->post_id = $save->id;
                    $save_point->point = $point->point;
                    $save_point->save();
                }
            }

            $tags = htmlentities(str_replace(' ','',trim($request->tags)));
            $linkages = Video::where('status', 1)->where('id','<>',$save->id)->where('tags','RLIKE',$tags)->orderBy('published_at','desc')->take(6)->get();
            if(count($linkages) > 0){
                foreach($linkages as $k=>$v){
                    $save_linkage = new VideoLinkage();
                    $save_linkage->parent_id = $save->id;
                    $save_linkage->child_id = $v->post_id;
                    $save_linkage->save();
                }
            }

            return redirect()->route('videos.index')->with('message', $save->title.' | Berhasil diupdate!');
        }catch(Exception $error){
            return redirect()->route('videos.index')->with('message', $error->getMessage());
        }
    }

    public function destroy($id)
    {
        //
    }
}

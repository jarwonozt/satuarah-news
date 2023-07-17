<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Point;
use App\Models\PointSetting;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\PostLinkage;
use App\Models\User;
use App\Services\ImageServices;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use App\Models\Tag;

class PostController extends Controller
{

    public function index()
    {
        return view('admin.posts.index');
    }

    public function create()
    {
        $user = auth()->user();

        foreach(config('app.user_type') as $k=>$v){
            if($user->getRoleNames()[0] == 'author'){
                $row_author = User::where('status', 1)->where('id', $user->id)->get();
                $categories = PostCategory::where('status', 1)->get();
            }elseif($user->getRoleNames()[0] == 'admin'){
                $row_author = User::where('status', 1)->where('id', $user->id)->get();
                $categories = PostCategory::where('status', 1)->get();
            }
             else{
                $row_author = User::where('status', 1)->orderBy('name','asc')->get();
                $categories = PostCategory::where('status', 1)->get();
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
        return view('admin.posts.create', [
            'categories' => PostCategory::where('status', true)->get(),
            'authors'    => $authors,
            'tags'       => Tag::where('status', true)->get(),

        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $image_setting = [
            'ori_width'=>config('app.img_size.ori_width'),
            'ori_height'=>config('app.img_size.ori_height'),
            'mid_width'=>config('app.img_size.mid_width'),
            'mid_height'=>config('app.img_size.mid_height'),
            'thumb_width'=>config('app.img_size.thumb_width'),
            'thumb_height'=>config('app.img_size.thumb_height')
        ];

        $image = '';
        if($request->file('image') != null){
            $data = array(
                'skala169' => array(
                    'width'=>$request->input('16_9_width'),
                    'height'=>$request->input('16_9_height'),
                    'x'=>$request->input('16_9_x'),
                    'y'=>$request->input('16_9_y')
                ),
                'skala43' => array(
                    'width'=>$request->input('4_3_width'),
                    'height'=>$request->input('4_3_height'),
                    'x'=>$request->input('4_3_x'),
                    'y'=>$request->input('4_3_y')
                ),
                'skala11' => array(
                    'width'=>$request->input('1_1_width'),
                    'height'=>$request->input('1_1_height'),
                    'x'=>$request->input('1_1_x'),
                    'y'=>$request->input('1_1_y')
                )
            );

            $image_data = [
                'file'=>$request->file('image'),
                'setting'=>$image_setting,
                'path'=>public_path('storage/posts/'),
                'modul'=>'posts',
                'data'=>$data
            ];

            $image_service = ImageServices::Crop($image_data);
            if($image_service['status'] == true){
                $image = $image_service['name'];
            }
        }

        // dd($image);

        $author = array_filter($request->author);

        try{
            $save = new Post();
            $save->code = Str::random(5);
            $save->title = $request->title;
            $save->slug = Str::slug($request->slug);
            $save->prefix = $request->prefix;
            $save->published_at = $request->published_at;
            $save->category_id = $request->category_id;
            $save->preview = $request->preview;
            $save->content = $request->content;
            $save->image = $image;
            $save->caption = $request->caption;
            $save->tags = implode(',', $request->tags);
            $save->status = $request->status;
            $save->type = $request->type;
            $save->created_by = auth()->user()->id;
            $save->save();

            foreach($author as $k=>$v){
                $point = PointSetting::where('modul','post')
                        ->where('user_type', $k)
                        ->where('category_id', $request->category_id)
                        ->first();
                if($point){
                    $save_point = new Point();
                    $save_point->modul = 'post';
                    $save_point->user_type = $k;
                    $save_point->user_id = $v;
                    $save_point->category_id = $request->category_id;
                    $save_point->post_id = $save->id;
                    $save_point->point = $point->point;
                    $save_point->save();
                }
            }

            if($request->tags){
                $tags = htmlentities(str_replace(' ','',trim($request->tags)));
                $linkages = Post::where('status', 1)->where('id','<>',$save->id)->where('tags','RLIKE',$tags)->orderBy('published_at','desc')->take(6)->get();
                if(count($linkages) > 0){
                    foreach($linkages as $k=>$v){
                        $save_linkage = new PostLinkage();
                        $save_linkage->parent_id = $save->id;
                        $save_linkage->child_id = $v->post_id;
                        $save_linkage->save();
                    }
                }
            }

            Cache::flush('posts');

            return redirect()->route('posts.index')->with('message', $save->title.' | Berhasil ditambahkan!');
        }catch(Exception $error){
            return redirect()->route('posts.index')->with('message', $error->getMessage());
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $user = auth()->user();

        foreach(config('app.user_type') as $k=>$v){
            if($user->getRoleNames()[0] == 'author'){
                $row_author = User::where('status', 1)->where('id', $user->id)->get();
                $categories = PostCategory::where('status', 1)->whereNotIn('id', [2, 6, 7])->get();
            }elseif($user->getRoleNames()[0] == 'admin'){
                $row_author = User::where('status', 1)->where('id', $user->id)->get();
                $categories = PostCategory::where('status', 1)->whereNotIn('id', [6, 7])->get();
            }
             else{
                $row_author = User::where('status', 1)->orderBy('name','asc')->get();
                $categories = PostCategory::where('status', 1)->whereNotIn('id', [6, 7])->get();
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
                $user_point = Point::where('modul', 'post')->where('user_type', $k)->where('post_id', $id)->first();
                if($user_point){
                    $authors[$k]['id'] = $user_point->user_id;
                }else {
                    $authors[$k]['id'] = '';
                }
            }
        }

        $data = Post::findOrFail($id);
        $postTags = explode(',', $data->tags);

        return view('admin.posts.edit',[
            'data'          => $data,
            'categories'    => $categories,
            'authors'       => $authors,
            'tags'          => Tag::whereNotIn('slug', $postTags)->where('status', true)->get(),
            'tagsCurrent'   => Tag::whereIn('slug', $postTags)->where('status', true)->get(),
        ]);
    }


    public function update(PostRequest $request, string $id)
    {
        $image_setting = [
            'ori_width'=>config('app.img_size.ori_width'),
            'ori_height'=>config('app.img_size.ori_height'),
            'mid_width'=>config('app.img_size.mid_width'),
            'mid_height'=>config('app.img_size.mid_height'),
            'thumb_width'=>config('app.img_size.thumb_width'),
            'thumb_height'=>config('app.img_size.thumb_height')
        ];

        $image = '';
        if($request->file('image') != null){
            $data = array(
                'skala169' => array(
                    'width'=>$request->input('16_9_width'),
                    'height'=>$request->input('16_9_height'),
                    'x'=>$request->input('16_9_x'),
                    'y'=>$request->input('16_9_y')
                ),
                'skala43' => array(
                    'width'=>$request->input('4_3_width'),
                    'height'=>$request->input('4_3_height'),
                    'x'=>$request->input('4_3_x'),
                    'y'=>$request->input('4_3_y')
                ),
                'skala11' => array(
                    'width'=>$request->input('1_1_width'),
                    'height'=>$request->input('1_1_height'),
                    'x'=>$request->input('1_1_x'),
                    'y'=>$request->input('1_1_y')
                )
            );

            $image_data = [
                'file'=>$request->file('image'),
                'setting'=>$image_setting,
                'path'=>public_path('storage/posts/'),
                'modul'=>'posts',
                'data'=> $data
            ];

            $image_service = ImageServices::Crop($image_data);
            if($image_service['status'] == true){
                $image = $image_service['name'];
            }
        }

        $author = array_filter($request->author);

        try{
            $save = Post::findOrFail($id);
            $save->title        = $request->title;
            $save->slug         = Str::slug($request->slug);
            $save->prefix       = $request->prefix;
            $save->published_at = $request->published_at;
            $save->category_id  = $request->category_id;
            $save->preview      = $request->preview;
            $save->content      = $request->content;
            $save->caption      = $request->caption;
            $save->tags         = implode(',', $request->tags);
            $save->status       = $request->status;
            $save->type         = $request->type;
            $save->updated_by   = auth()->user()->id;
            if($image){
                $save->image    = $image;
            }
            $save->save();



            $points = Point::where('modul', 'post')->where('post_id', $id)->count();
            if($points > 0){
                Point::where('modul', 'post')->where('post_id', $id)->delete();
            }

            foreach($author as $k=>$v){
                $point = PointSetting::where('modul','post')
                        ->where('user_type', $k)
                        ->where('category_id', $request->category_id)
                        ->first();

                if($point){
                    $save_point = new Point();
                    $save_point->modul = 'post';
                    $save_point->user_type = $k;
                    $save_point->user_id = $v;
                    $save_point->category_id = $request->category_id;
                    $save_point->post_id = $save->id;
                    $save_point->point = $point->point;
                    $save_point->save();
                }
            }

            Cache::flush("post-$save->code");
            return redirect()->route('posts.index')->with('message', $save->title.' | Berhasil diupdate!');
        }catch(Exception $error){
            dd($error->getMessage());
            return redirect()->route('posts.index')->with('message', $error->getMessage());
        }
    }


    public function destroy(string $id)
    {
        //
    }
}

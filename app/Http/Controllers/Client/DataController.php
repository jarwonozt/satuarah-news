<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\FileLinkage;
use App\Models\FileCategory;
use App\Models\Image;
use App\Models\Menu;
use App\Models\Office;
use App\Models\Officer;
use App\Models\Page;
use App\Models\User;
use App\Models\PageCategory;
use App\Models\Photo;
use App\Models\PhotoContent;
use App\Models\PhotoLinkage;
use App\Models\Photos;
use App\Models\Point;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Service\Service;
use App\Models\Service as ServiceService;
use App\Models\Service\ServiceDetail;
use App\Models\Service\ServiceRequest;
use App\Models\ServiceCategory;
use App\Models\Tag;
use App\Models\Video;
use App\Models\VideoCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class DataController extends Controller
{

    public static function menu()
    {
        $data = Cache::rememberForever('menu', function(){
            $row = Menu::where('status', 1)->orderBy('order', 'ASC')->get();
            return $row;
        });
        return $data;
    }

    public static function trending()
    {
        $data = Cache::rememberForever('trending', function(){
            $row = Post::where('status', 1)->where('type', 3)->orderBy('published_at', 'DESC')->paginate(10);
            return $row;
        });
        return $data;
    }

    public static function headline()
    {
        $data = Cache::rememberForever('headline', function(){
            $row = Post::where('status', 1)->where('type', 2)->orderBy('published_at', 'DESC')->paginate(10);
            return $row;
        });
        return $data;
    }

    public static function popular()
    {
        $data = Cache::remember('popular', 60 * 60 * 12, function(){
            $row = Post::where('status', 1)->where('published_at','>=', today()->subDays(30))->orderBy('counter', 'DESC')->paginate(10);
            return $row;
        });
        return $data;
    }

    public static function post($code)
    {

        $data = Cache::rememberForever("post-$code", function() use($code){
            $row = Post::with('getLinkage')->where(DB::raw('BINARY `code`'), $code)->where('status', 1)->first();
            return $row;
        });
        return $data;
    }

    public static function posts($category = null, $page = null)
    {
        if($category != null){
            $category_id = PostCategory::where('slug', $category)->first()->id;
            $id = PostCategory::where('parent_id', $category_id)->pluck('id')->toArray();
            array_push($id, $category_id);
            // dd($id);

            $data = Cache::remember("posts-$category-$page", 60 * 60 * 12, function () use($id, $category_id) {
                if($category_id){
                    $row = Post::where('status', 1)->whereIn('category_id', $id)->orderBy('published_at', 'DESC')->paginate(30);
                }else{
                    $row = Post::where('status', 1)->orderBy('published_at', 'DESC')->paginate(30);
                }
                return $row;
            });

        }else{
            $data = Cache::remember("posts-$page", 60 * 60 * 12, function () {
                $row = Post::where('status', 1)->orderBy('published_at', 'DESC')->paginate(30);
                return $row;
            });
        }
        return $data;
    }

    // public static function postOffice($slug = null)
    // {
    //     $category =
    // }

    public static function postsCategory($category = null, $page = null)
    {
        $category_post = PostCategory::where('slug', $category)->first();
        if(empty($category_post)){
            $category_id = null;
        }else{
            $category_id = $category_post->id;
        }

        $id = PostCategory::where('parent_id', $category_id)->pluck('id')->toArray();
        array_push($id, $category_id);

        $data = Cache::remember("postscategory-$category-$page", 60 * 60 * 12, function () use($id, $category_id) {
            if($category_id){
                $row = Post::where('status', 1)->whereIn('category_id', $id)->orderBy('published_at', 'DESC')->simplePaginate(20);
            }else{
                $row = Post::where('status', 1)->orderBy('published_at', 'DESC')->simplePaginate(20);
            }
            return $row;
        });

        return $data;
    }

    public static function postAuthor($slug = null, $page = null)
    {
        $author_id = User::where('slug', $slug)->first()->id;

        $data = Cache::remember("author-$slug-$page", 60 * 60 * 12, function () use($author_id) {
            $row = Point::join('posts', 'posts.id', '=', 'post_id')
                ->where('user_id', $author_id)
                ->where('modul', 'post')
                ->where('posts.status', 1)->with('getCategory', 'getPost')
                ->orderBy('posts.published_at', 'desc')->paginate(30)->withQueryString();
            return $row;
        });

        return $data;
    }

    public static function postOffice($slug = null)
    {
        $kota = ucwords(str_replace('-', ' ', $slug));
        try{
            $user = User::where('kota', 'LIKE', "%$kota%")->pluck('id')->toArray();

            // if($user){
                $row = Post::where('status', 1)
                        ->whereIn('created_by', $user)
                        ->orderBy('published_at', 'DESC')
                        ->paginate(12)->withQueryString();
                return $row;
            // }else{
            //     $row = Post::where('status', 1);
            //     $row = $row->orWhere(function($q) use($kota) {
            //         // dd($kota);
            //         $q->where('title', 'LIKE', "%$kota%");
            //     });
            //     $row = $row->orderBy('published_at', 'DESC')->paginate(30)->withQueryString();
            //     return $row;
            // }
        }catch(Exception $e){
            return back();
        }
    }

    public static function search($querry = null)
    {
        try {
            $terms = ucwords(str_replace('-', ' ', $querry));
            $data = Post::where('status', 1)->where('title', 'like', "%$terms%");
            $data = $data->orWhere(function($q) use($terms) {
                $q->where('content', 'LIKE', "%$terms%")
                ->where('tags', 'LIKE', "%$terms%");
            });

            $data = $data->orderBy('published_at', 'DESC')->simplePaginate(20)->withQueryString();

            return $data;
        } catch (Exception $e) {
            return back();
        }
    }

    public static function service($category)
    {
        $category_id = ServiceCategory ::where('slug', $category)->first()->id;
        $data = Cache::rememberForever("services-$category_id", function() use($category_id){
            $row = ServiceService::where('status', 1)->where('category_id', $category_id)->get();
            return $row;
        });
        return $data;
    }

    public static function file($slug)
    {
        $data = Cache::rememberForever("file-$slug", function() use($slug){
            $row = File::where('slug', $slug)->first();
            return $row;
        });
        return $data;
    }

    public static function dataFile($slug)
    {
        $id = File::where('slug', $slug)->first()->id;
        $data = Cache::rememberForever("filelinkage-$id", function() use($id){
            $row    = FileLinkage::where('file_id', $id)->get();
            return $row;
        });
        return $data;
    }

    public static function office($slug)
    {
        $data = Cache::rememberForever("office-$slug", function() use($slug){
            $row = Office::where('slug', $slug)->first();
            return $row;
        });
        return $data;
    }

    public static function offices()
    {
        $data = Cache::rememberForever('offices', function(){
            $row = Office::orderBy('title', 'ASC')->get();
            return $row;
        });
        return $data;
    }

    public static function files($category_id)
    {
        $data = Cache::rememberForever("files-$category_id", function() use($category_id){
            $row = File::where('status', 1)->where('category_id', $category_id)->orderBy('created_at', 'DESC')->get();
            return $row;
        });
        return $data;
    }

    public static function video($slug)
    {
        $update_counter = Video::where('slug', $slug)->increment('counter', 1);

        $data = Cache::rememberForever("$slug", function() use($slug){
            $row = Video::where('slug', $slug)->where('status', 1)->first();
            return $row;
        });
        return $data;
    }

    public static function videos($category = null, $page = null)
    {
        if($category != null){
            $category_id = VideoCategory::where('slug', $category)->first()->id;
            $id = VideoCategory::where('parent_id', $category_id)->pluck('id')->toArray();
            array_push($id, $category_id);

            $data = Cache::remember("videos-$category-$page", 60 * 60 * 12, function () use($id, $category_id) {
                if($category_id){
                    $row = Video::where('status', 1)->whereIn('category_id', $id)->orderBy('published_at', 'DESC')->paginate(12)->withQueryString();
                }else{
                    $row = Video::where('status', 1)->orderBy('published_at', 'DESC')->paginate(12);
                }
                return $row;
            });
        }else{
            $data = Cache::remember("videos-$page", 60 * 60 * 12, function () {
                $row = Video::where('status', 1)->orderBy('published_at', 'DESC')->paginate(12);
                return $row;
            });
        }
        return $data;
    }

    public static function images($id)
    {
        $data = Cache::rememberForever("images-$id", function () use($id) {
            $row = Image::where('status', 1)->where('category_id', $id)->simplePaginate(10);
            return $row;
        });
        return $data;
    }

    public static function photos()
    {
        $data = Cache::rememberForever("photos", function () {
            $row = Photo::where('status', 1)->paginate(10);
            return $row;
        });
        return $data;
    }


    public static function photoDetail($slug)
    {
        $data = Cache::rememberForever("photos-$slug", function () use($slug) {
            $row['parent']      = Photo::where('status', 1)->where('slug', $slug)->first();
            $row['data_photo']  = PhotoLinkage::where('photo_id', $row['parent']->id)->get();
            $row['author']      = Point::where('modul', 'photo')->where('post_id', $row['parent']->id)->get();
            return $row;
        });
        return $data;
    }

    public static function page($slug)
    {
        $data = Cache::rememberForever("$slug", function() use($slug){
            $row = Page::where('slug', $slug)->where('status', 1)->first();
            return $row;
        });
        return $data;
    }

    public static function pages($slug, $page = null)
    {
        $category_id = PageCategory::where('slug', $slug)->where('status', 1)->value('id');
        $data = Cache::rememberForever("pages-$category_id-$page", function() use($category_id){
            $rows = Page::where('category_id', $category_id)->where('status', 1)->orderBy('created_at', 'asc')->paginate(20);
            return $rows;
        });
        return $data;
    }

    public static function archives()
    {
        $data = Cache::rememberForever("archives", function() {
            $row = FileCategory::with('getFiles')->where('id', '!=', 1)->orderBy('created_at', 'DESC')->get();
            return $row;
        });
        return $data;
    }

    public static function tags($tag, $page = null)
    {
        $data = Cache::remember("post-$tag-$page", 60 * 60 * 12, function() use($tag){
            $row = Post::where('status', 1)->where('tags', 'LIKE', "%$tag%")->paginate(20)->withQueryString();
            return $row;
        });
        return $data;
    }

    public static function listTag()
    {
        $data = Cache::remember("post", 60 * 60 * 12, function() {
            $row = Post::where('status', 1)->pluck('tags');
            return $row;
        });
        return $data;
    }

    public static function author($slug)
    {
        $data = Cache::rememberForever("user-$slug", function() use($slug){
            $row = User::where('status', 1)->where('slug', $slug)->first();
            return $row;
        });
        return $data;
    }

    public static function counterPost($code){
        $row = Post::where('code', $code);
        $counter = $row->first()->counter + 1;
        $row = $row->increment('counter', 1);

        return $counter;
    }

    public static function postSlug($slug)
    {
        $data = Post::where('slug', $slug)->first();
        return $data;
    }

    // SULBAR KEMENAG
    public function officers(){
        $data = Cache::rememberForever("officers", function() {
            $rows = Officer::where('status', 1)->orderBy('order', 'asc')->get();
            return $rows;
        });
        return $data;
    }
}

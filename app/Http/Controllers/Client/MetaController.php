<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MetaController extends Controller
{
    public static function sitemap()
    {
        $row =  PostCategory::get();
        $data['data'] = $row;
        $data['date'] = now()->timestamp;
        $data['url']  = env('APP_URL');

        return response()->view('sitemap', compact('data'))->header('Content-Type', 'text/xml');
    }

    public static function sitemapDetail($category)
    {
        $category_id    = PostCategory::where('slug', $category)->first()->id;
        $post           = Post::where('category_id', $category_id)->latest()->get();
        $data['data']   = $post;
        $data['date']   = now()->timestamp;

        return response()->view('sitemap-detail', compact('data'))->header('Content-Type', 'text/xml');
    }
}

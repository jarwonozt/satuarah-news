<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Str;

class ScreenController extends Controller
{
    public function redirect($category, $slug, DataController $data)
    {
        $row = $data->postSlug($slug);
        return redirect($row->url);

    }

    public function post($category, $slug, $code, DataController $data)
    {
        $row = $data->post($code);
        seo()
            ->site(config('app.name'))
            ->url($row->url)
            ->title($row->title)
            ->description(Str::limit($row->preview, 150))
            ->image(config('app.url').$row->images['thumbnail'])
            ->twitterCreator('@bacapolitikcom')
            ->twitterSite('@bacapolitikcom')
            ->twitterTitle($row->title)
            ->twitterDescription($row->preview)
            ->twitterImage(config('app.url').$row->images['thumbnail']);

        if($row){
            return view('client.page.post', [
                'meta'          => $data->post($code),
                'banner_header' => $data->images(1),
                'banner_footer' => $data->images(3),
                'menu'          => $data->menu(),
                'menu_office'   => $data->offices(),
                'data'          => $row,
                'posts'         => $data->posts($category),
                'data_kepegawaian'  => $data->files(3),
                'infografis'        => $data->images(1),
                'video'         => $data->videos(),
                'files'         => $data->files(1),
                'counter'       => $data->counterPost($code),
                'popular'       => $data->popular(),
                'iklan_sidebar' => $data->images(2),
            ]);
        }else{
            return redirect(env('APP_URL'));
        }
    }

    public function file($slug, DataController $data)
    {
        return view('client.screen.file',[
            'menu'          => $data->menu(),
            'banner_header' => $data->images(1),
            'banner_home'   => $data->images(2),
            'banner_footer' => $data->images(3),
            'menu_office'   => $data->offices(),
            'data'          => $data->file($slug),
            'data_file'     => $data->dataFile($slug),
            'popular'       => $data->popular(),
            'files'         => $data->files(1),
            'infografis'    => $data->images(1),
            'video'         => $data->videos(),
        ]);
    }

    public function office($slug, DataController $data)
    {
        return view('client.screen.office',[
            'menu'          => $data->menu(),
            'banner_header' => $data->images(1),
            'banner_home'   => $data->images(2),
            'banner_footer' => $data->images(3),
            'menu_office'   => $data->offices(),
            'data'          => $data->office($slug),
            'posts'         => $data->postOffice($slug),
        ]);
    }

    public function page($slug, DataController $data)
    {
        seo()
            ->site(config('app.name'))
            ->url($data->page($slug)->url)
            ->title($data->page($slug)->title);
        return view('client.page.page-static',[
            'meta'          => $data->page($slug),
            'banner_header' => $data->images(3),
            'banner_home'   => $data->images(2),
            'banner_footer' => $data->images(3),
            'menu'          => $data->menu(),
            'menu_office'   => $data->offices(),
            'data'          => $data->page($slug),
        ]);
    }

    public function video($slug, DataController $data)
    {
        return view('client.screen.video',[
            'meta'          => $data->video($slug),
            'banner_header' => $data->images(1),
            'banner_home'   => $data->images(2),
            'banner_footer' => $data->images(3),
            'menu'          => $data->menu(),
            'menu_office'   => $data->offices(),
            'data'          => $data->video($slug),
            'files'         => $data->files(1),
            'infografis'    => $data->images(1),
            'video'         => $data->videos(),
            'popular'       => $data->popular(),
            'data_kepegawaian' => $data->files(3),
        ]);
    }

    public function author(Request $request, $slug, DataController $data)
    {
        return view('client.screen.author',[
            'meta'          => $data->video($slug),
            'banner_header' => $data->images(1),
            'banner_home'   => $data->images(2),
            'banner_footer' => $data->images(3),
            'menu'          => $data->menu(),
            'menu_office'   => $data->offices(),
            'author'        => $data->author($slug),
            'data'          => $data->postAuthor($slug, $request->page),
            'files'         => $data->files(1),
            'infografis'    => $data->images(1),
            'video'         => $data->videos(),
            'popular'       => $data->popular()
        ]);
    }

    public function photo($slug, DataController $data)
    {
        // dd($data->photoDetail($slug));
        return view('client.screen.photo',[
            'meta'          => $data->video($slug),
            'banner_header' => $data->images(1),
            'banner_home'   => $data->images(2),
            'banner_footer' => $data->images(3),
            'menu'          => $data->menu(),
            'menu_office'   => $data->offices(),
            'data'          => $data->photoDetail($slug),
            // 'files'         => $data->files(1),
            'data_kepegawaian' => $data->files(3),
            'infografis'    => $data->images(1),
            'video'         => $data->videos(),
            'popular'       => $data->popular()
        ]);
    }
}

<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Tag;
use Illuminate\Http\Request;
use Faker\Factory as Faker;

class HomeController extends Controller
{
    public function index(DataController $data)
    {
        seo()->title(config('app.name'));

        return view('client.index', [
            'menu' => $data->menu(),
            'menu_office' => $data->offices(),
            'banner_header' =>$data->images(1),
            'banner_home' =>$data->images(2),
            'banner_footer' =>$data->images(3),
            'trending' => $data->trending(),
            'headline' => $data->headline(),
            'files' => $data->files(1),
            'popular' => $data->popular(),
            'main_services' => $data->service('layanan-utama'),
            'services' => $data->service('layanan-wilayah'),
            'iklan_sidebar' => $data->images(4),
            'infografis' => $data->images(5),
            'peristiwa' => $data->photos(),
            'video' => $data->videos(),
            'video_profile' => $data->videos('profile'),
            'terbaru' => $data->posts(),
            'wilayah' => $data->posts('nasional'),
            'daerah' => $data->posts('daerah'),
            'article' => $data->posts('hukum'),
            'opini' => $data->posts('opini'),
            'suara_rakyat' => $data->posts('suara-rakyat'),
            'hukum' => $data->posts('hukum'),
            'tags' => Tag::inRandomOrder()->limit(10)->get(),
        ]);
    }
}

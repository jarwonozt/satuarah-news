<?php

namespace App\Http\Controllers\Client;

use App\Charts\MonthlyUsersChart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ScreensController extends Controller
{
    public function offices(DataController $data)
    {
        return view('client.screens.offices', [
            'banner_header' =>$data->images(1),
            'banner_home' =>$data->images(2),
            'banner_footer' =>$data->images(3),
            'menu'      => $data->menu(),
            'menu_office' => $data->offices(),
            'data'=>$data->offices(),
            'popular'      => $data->popular(),
            'infografis'    => $data->images(5),
            'video'         => $data->videos(),
            'files'         => $data->files(1),
            'iklan_sidebar' => $data->images(4),
        ]);
    }

    public function services(DataController $data)
    {
        return view('client.screens.services', [
            'banner_header' =>$data->images(1),
            'banner_home' =>$data->images(2),
            'banner_footer' =>$data->images(3),
            'menu'      => $data->menu(),
            'menu_office' => $data->offices(),
            'popular'      => $data->popular(),
            'infografis'    => $data->images(5),
            'video'         => $data->videos(),
            'files'         => $data->files(1),
            'data'=>$data->service('layanan-wilayah'),
            'iklan_sidebar' => $data->images(4),
        ]);
    }

    public function ptsp(DataController $data, MonthlyUsersChart $charts)
    {

        return view('client.screens.ptsp', [
            'banner_header' => $data->images(1),
            'banner_home'   => $data->images(2),
            'banner_footer' => $data->images(3),
            'menu'          => $data->menu(),
            'menu_office'   => $data->offices(),
            'popular'       => $data->popular(),
            'infografis'    => $data->images(5),
            'video'         => $data->videos(),
            'files'         => $data->files(1),
            'data'          => $data->services(),
            'donut_data'    => $charts->dataRequestServiceDonut($data->services()['data']),
            'grafik_tatausaha'    => $charts->grafikTataUsaha($data->services()['tata_usaha']),
            'grafik_pendidikan_agama' => $charts->grafikPendidikanAgama($data->services()['pendidikan_agama']),
            'grafik_pendidikan_madrasah' => $charts->grafikPendidikanMadrasah($data->services()['pendidikan_madrasah']),
            'grafik_hajidanumrah' => $charts->grafikHajidanumrah($data->services()['hajidanumrah']),
            'grafik_masyarakat' => $charts->grafikBimbinganMasyarakat($data->services()['masyarakat']),
            'grafik_masyarakat_kristen' => $charts->grafikBimbinganMasyarakatKristen($data->services()['masyarakat_kristen']),
            'grafik_masyarakat_katolik' => $charts->grafikBimbinganMasyarakatKatolik($data->services()['masyarakat_katolik']),
            'grafik_masyarakat_hindu' => $charts->grafikBimbinganMasyarakatHindu($data->services()['masyarakat_hindu']),
            'grafik_masyarakat_budha' => $charts->grafikBimbinganMasyarakatBudha($data->services()['masyarakat_budha']),
        ]);
    }

    public function files(DataController $data)
    {
        return view('client.screens.files', [
            'banner_header' =>$data->images(1),
            'banner_home' =>$data->images(2),
            'banner_footer' =>$data->images(3),
            'menu'      => $data->menu(),
            'menu_office' => $data->offices(),
            'popular'=>$data->popular(),
            'data'=>$data->files(1),
            'infografis'    => $data->images(5),
            'video'         => $data->videos('video'),
            'iklan_sidebar' => $data->images(4),
        ]);
    }

    public function posts(Request $request, $category, DataController $data)
    {
        return view('client.pages.posts',[
            'banner_header' => $data->images(1),
            'banner_home'   => $data->images(2),
            'banner_footer' => $data->images(3),
            'menu'          => $data->menu(),
            'menu_office'   => $data->offices(),
            'popular'       => $data->popular(),
            'infografis'    => $data->images(5),
            'video'         => $data->videos('video'),
            'files'         => $data->files(1),
            'data'          => $data->postsCategory($category, $request->page),
            'title'         => $category,
            'iklan_sidebar' => $data->images(4),
        ]);
    }

    public function archives(DataController $data)
    {
        return view('client.screens.archives', [
            'banner_header' =>$data->images(1),
            'banner_home' =>$data->images(2),
            'banner_footer' =>$data->images(3),
            'menu'          => $data->menu(),
            'menu_office'   => $data->offices(),
            'popular'      => $data->popular(),
            'infografis'    => $data->images(5),
            'video'         => $data->videos(),
            'files'         => $data->files(1),
            'data'          => $data->archives(),
            'iklan_sidebar' => $data->images(4),
        ]);
    }

    public function videos(Request $request, $category = null, DataController $data)
    {
        return view('client.screens.videos', [
            'banner_header' =>$data->images(1),
            'banner_home'   =>$data->images(2),
            'banner_footer' =>$data->images(3),
            'menu'          => $data->menu(),
            'menu_office'   => $data->offices(),
            'popular'       => $data->popular(),
            'infografis'    => $data->images(5),
            'video'         => $data->videos(),
            'files'         => $data->files(1),
            'data'          => $data->videos($category, $request->page),
            'title'         => Str::upper($category),
            'data_kepegawaian' => $data->files(3),
            'iklan_sidebar' => $data->images(4),
        ]);
    }

    public function podcasts(Request $request, DataController $data)
    {
        return view('client.screens.podcasts', [
            'banner_header' =>$data->images(1),
            'banner_home' =>$data->images(2),
            'banner_footer' =>$data->images(3),
            'menu'          => $data->menu(),
            'menu_office'   => $data->offices(),
            'popular'      => $data->popular(),
            'infografis'    => $data->images(5),
            'video'         => $data->videos(),
            'files'         => $data->files(1),
            'data'          => $data->videos('podcast', $request->page),
            'iklan_sidebar' => $data->images(4),
        ]);
    }

    public function pages($category, DataController $data)
    {
        return view('client.screens.pages',[
            'banner_header' =>$data->images(1),
            'banner_home' =>$data->images(2),
            'banner_footer' =>$data->images(3),
            'menu'          => $data->menu(),
            'menu_office'   => $data->offices(),
            'title'         => Str::title($category),
            'data'          => $data->pages($category),
            'popular'      => $data->popular(),
            'iklan_sidebar' => $data->images(4),
            'iklan_sidebar' => $data->images(4),

        ]);
    }

    public function infografis(DataController $data)
    {
        return view('client.pages.infografis', [
            'menu'          => $data->menu(),
            'menu_office'   => $data->offices(),
            'banner_header' => $data->images(1),
            'banner_home'   => $data->images(2),
            'banner_footer' => $data->images(3),
            'popular'      => $data->popular(),
            'video'         => $data->videos(),
            'files'         => $data->files(1),
            'data'          => $data->images(1),
            'iklan_sidebar' => $data->images(4),
        ]);
    }

    public function tags(Request $request, $q, DataController $data)
    {
        return view('client.pages.tags', [
            'banner_header' => $data->images(1),
            'banner_home'   => $data->images(2),
            'banner_footer' => $data->images(3),
            'files'         => $data->files(1),
            'menu'          => $data->menu(),
            'popular'       => $data->popular(),
            'infografis'    => $data->images(5),
            'video'         => $data->videos(),
            'files'         => $data->files(1),
            'title'         => "Hasil Tag : #$request->q",
            'data'          => $data->tags($q, $request->page),
            'iklan_sidebar' => $data->images(4),
        ]);
    }

    public function search(Request $request, DataController $data){
        return view('client.pages.search',[
            'banner_header' =>$data->images(1),
            'banner_home' =>$data->images(2),
            'banner_footer' =>$data->images(3),
            'files'     => $data->files(1),
            'menu'      => $data->menu(),
            'data'      => $data->search($request->q),
            'popular'  => $data->popular(),
            'infografis'    => $data->images(5),
            'video'         => $data->videos(),
            'files'         => $data->files(1),
            'title'     => "Hasil Pencarian: $request->q",
            'iklan_sidebar' => $data->images(4),
        ]);
    }

    public function officers(DataController $data){
        return view('client.screens.officers',[
            'banner_header' =>$data->images(1),
            'banner_home'   =>$data->images(2),
            'banner_footer' =>$data->images(3),
            'menu'          => $data->menu(),
            'menu_office'   => $data->offices(),
            'title'         => 'Struktur Organisasi',
            'data'          => $data->officers(),
            'iklan_sidebar' => $data->images(4),
            'popular'       => $data->popular()
        ]);
    }

    public function photos(DataController $data){
        return view('client.screens.photos',[
            'banner_header' =>$data->images(1),
            'banner_home'   =>$data->images(2),
            'banner_footer' =>$data->images(3),
            'files'         => $data->files(1),
            'menu'          => $data->menu(),
            'menu_office'   => $data->offices(),
            // 'title'         => 'Struktur Organisasi',
            'data'          => $data->photos(),
            'iklan_sidebar' => $data->images(4),
            'popular'       => $data->popular()
        ]);
    }
}

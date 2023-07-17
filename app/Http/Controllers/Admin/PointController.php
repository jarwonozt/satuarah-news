<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Point;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PointController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $month = $request->get('month', date('m'));
        $year = $request->get('year', date('Y'));

        $data['date_now'] = [
            'month' => $month,
            'year' => $year,
        ];

        $minyears  = Carbon::createFromFormat('Y-m-d H:i:s', Point::min('created_at'))->year;
        $maxyears  = Carbon::createFromFormat('Y-m-d H:i:s', Point::max('created_at'))->year;

        $data['date']['month'] = array(1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember');
        for($i=$minyears;$i<=$maxyears;$i++){
            $data['date']['years'][$i] = $i;
        }

        $row = Point::select(DB::raw('user_id, sum(point) as totalPoint, count(post_id) as totalPost'))->where('point','>',0);

        $row = $row->whereMonth('created_at', $month)->whereYear('created_at', $year);

        $points = $row->groupBy('user_id')
                        ->orderBy('totalPoint', 'desc')
                        ->get();

        foreach ($points as $k => $v) {
            $row_view = Point::whereMonth('created_at',$month)
                    ->whereYear('created_at',$year)
                    ->where('user_id',$v->user_id)
                    ->get();

            $post_id = array();
            foreach($row_view as $a=>$b){
                $post_id[] = $b->post_id;
            }

            $view_post = (isset($post_id)) ? Post::whereIn('id', $post_id)->sum('counter') : 0;

            $data['data'][$k]['name']           = $v->getUser->name;
            $data['data'][$k]['total_view']     = number_format($view_post);
            $data['data'][$k]['total_point']    = number_format($v->totalPoint);
            $data['data'][$k]['total_post']     = number_format($v->totalPost);
        }
        // dd($data);
        return view('admin.points.index', [
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

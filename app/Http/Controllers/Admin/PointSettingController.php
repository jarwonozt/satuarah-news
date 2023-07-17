<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PointSetting;
use App\Models\PostCategory;
use Exception;
use Illuminate\Http\Request;

class PointSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $no = 0;
        foreach(config('app.user_type') as $k=>$v){
            $no++;
            $data[$no]['id'] = $k;
            $data[$no]['name'] = $v;
        }



        return view('admin.points.settings.index', [
            'data' => $data
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
        $data['title'] = config('app.user_type')[$id];
        $data['id'] = $id;
        $data['data'] = array();
        foreach(config('app.set_point') as $k=>$v){
            $data['data'][$k]['name'] = $v['name'];
            $data['data'][$k]['cat'] = $v['category'];
            if($v['category'] == 1){
                if($k == 'post'){
                    $rowCategory = PostCategory::where('status', 1)->get();
                }
                if($rowCategory){
                    foreach($rowCategory as $a=>$b){
                        $data['data'][$k]['category'][$a]['category_id'] = $b->id;
                        $data['data'][$k]['category'][$a]['name'] = $b->name;

                        $dataGetPoint = PointSetting::where('category_id', $b->id)->where('modul',$k)->where('user_type',$id)->first();
                        if($dataGetPoint){
                            $data['data'][$k]['category'][$a]['point'] = $dataGetPoint->point;
                        }else{
                            $data['data'][$k]['category'][$a]['point'] = 0;
                        }
                    }
                }
            }else{
                $dataGetPoint = PointSetting::where('user_type', $id)->where('modul',$k)->first();
                if($dataGetPoint){
                    $data['data'][$k]['point'] = $dataGetPoint->point;
                }else{
                    $data['data'][$k]['point'] = 0;
                }
            }
        }

        return view('admin.points.settings.edit', [
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $modul = $request->input('modul');
        $category = $request->input('category');
        $point = $request->input('point');
        try{
            foreach($modul as $k=>$v){
                $count = PointSetting::where('category_id',$category[$k])->where('modul',$v)->where('user_type',$id)->count();
                if($count > 0){
                    $dataSimpan = PointSetting::where('modul',$v)
                                    ->where('user_type',$id)
                                    ->where('category_id',$category[$k])
                                    ->update(['point'=>$point[$k]]);
                }else{
                    $dataSimpan = new PointSetting;
                    $dataSimpan->modul = $v;
                    $dataSimpan->user_type = $id;
                    $dataSimpan->category_id = $category[$k];
                    $dataSimpan->point = $point[$k];
                    $dataSimpan->save();
                }
            }
            return redirect()->route('pointsettings.index')->with('message','Point berhasil diperbarui! 😍');
        }catch(Exception $error){
            return redirect()->route('pointsettings.index')->with('message', 'Ups, Terdapat kesalahan! 😭'. $error->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Point;
use App\Models\PointSetting;
use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\VideoLinkage;
use Exception;
use Illuminate\Support\Str;
use App\Services\TreeServices;
use Carbon\Carbon;

class MenuController extends Controller
{

    public function index()
    {
        return view('admin.menus.index');
    }

    public function getTreeKategori($slc,$cid){
        if(empty($cid)){
            $kategori = Menu::where('status', 1)->get();
        }else{
            $kategori = Menu::where('status', 1)->where('parent_id', '<>', $cid)->where('category_id', '<>', $cid)->get();
        }
        $dataTree = array();
        foreach($kategori as $kat){
            $dataTree[$kat['parent_id']][] = $kat;
        }
        return TreeServices::treeDataOption($dataTree,0,0,$slc);
    }

    public function create()
    {
        // $categories = MenuCategory::where('status', 1)->get();
        $parents = Menu::where('status', 1)->get();
        $data['treeKategori'] = $this->getTreeKategori(0,'');

        return view('admin.menus.create',  [
            // 'categories' => $categories,
            'parents' => $parents,
            'data' => $data,
        ]);
    }


    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'title'=>'required|max:255|unique:posts',
            'slug'=>'required|unique:posts',
            'category_id'=>'required',
        ]);

        $menu       = Menu::where('id', $request->parent_id)->first();
        $parent_id  = $menu->parent_id;
        $parent     = Menu::where('parent_id', $parent_id)->max('order');

        if(empty($parent)){
            $order = Menu::max('order')+1;
        }else{
            $order = $parent;
        }

        try{
            $save = new Menu();
            $save->name         = $request->title;
            $save->slug         = $request->slug;
            $save->order        = $order;
            $save->status       = $request->status;
            $save->type         = $request->type;
            $save->parent_id    = $parent_id ? $parent_id : 0;
            $save->category_id  = $request->category_id ? $request->category_id : 0;
            $save->created_by   = auth()->user()->id;
            $save->created_at   = Carbon::now();
            $save->save();

            return redirect()->route('menus.index')->with('message', ucwords($save->name).' | Berhasil ditambahkan!');
        }catch(Exception $error){
            return redirect()->route('menus.index')->with('message', $error->getMessage());
        }
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data['menu']           = Menu::findOrFail($id);
        // $data['categories']     = MenuCategory::where('status', 1)->get();
        $data['parents']        = Menu::where('status', 1)->get();
        $data['parent']         = Menu::where('id', $data['menu']['parent_id'])->first();
        $data['treeKategori']   = $this->getTreeKategori(0,'');

        // dd($data);
        return view('admin.menus.edit',[
            'data'=> $data,
        ]);
    }


    public function update(Request $request, $id)
    {

        $menu       = Menu::where('id', $request->parent_id)->first();
        $parent_id  = $menu->parent_id;
        $parent     = Menu::where('parent_id', $parent_id)->max('order');

        if(empty($parent)){
            $order = Menu::max('order')+1;
        }else{
            $order = $parent;
        }

        try{
            $save = Menu::findOrFail($id);
            $save->name         = $request->title;
            $save->slug         = $request->slug;
            $save->status       = $request->status;
            $save->type         = $request->type;
            $save->order        = $order;
            $save->parent_id    = $parent_id ? $parent_id : 0;
            $save->category_id  = $request->category_id ? $request->category_id : 0;
            $save->created_by   = auth()->user()->id;
            $save->created_at   = Carbon::now();
            $save->save();

            return redirect()->route('menus.index')->with('message', ucwords($save->name).' | Berhasil diupdate!');
        }catch(Exception $error){
            return redirect()->route('menus.index')->with('message', $error->getMessage());
        }
    }


    public function destroy($id)
    {
        //
    }

}

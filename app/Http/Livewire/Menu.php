<?php

namespace App\Http\Livewire;

use App\Models\Menu as ModelMenu;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\MenuCategory;
use Illuminate\Support\Facades\Cache;

class Menu extends Component
{
    public $name, $slug, $parent_id, $type, $status;
    public $data;
    public $search;
    public $showEditModal = false;

    public $category_id = 1;

    public function create()
    {
        $this->showEditModal = false;
        // $this->categories = MenuCategory::where('status', 1)->get();
        $this->dispatchBrowserEvent('show-form');
    }

    public function store()
    {
        // $menu       = ModelMenu::where('id', $this->parent_id)->first();
        // $parent_id  = $menu->parent_id;
        $parent     = ModelMenu::where('parent_id', $this->parent_id)->max('order');

        if(empty($parent)){
            $order = ModelMenu::max('order')+1;
        }else{
            $order = $parent+1;
        }

        try{
            $save = new ModelMenu;
            $save->name = strtoupper($this->name);
            $save->slug = $this->slug;
            $save->order = $order;
            $save->parent_id = $this->parent_id ? $this->parent_id : 0;
            $save->category_id = $this->category_id;
            $save->type = $this->type ? $this->type : 0;
            $save->status = $this->status;
            $save->created_by = auth()->user()->id;
            $save->save();

            Cache::flush("menu");

            session()->flash('message', $save->name.'. Berhasil diupdate!');
        }catch(Exception $e){
            session()->flash('message', $e->getMessage());
        }


        return redirect()->route('menus.index');
    }
    public function edit(ModelMenu $data)
    {
        $this->showEditModal = true;
        // $this->categories = MenuCategory::where('status', 1)->get();
        $this->dispatchBrowserEvent('show-form');
        // dd($data);
        $this->name = $data->name;
        $this->slug = $data->slug;
        $this->type = $data->type;
        $this->status = $data->status;
        $this->parent_id = $data->parent_id;
        $this->data = $data;
    }
    public function update()
    {
        $save = $this->data;
        $save->name = $this->name;
        $save->slug = $this->slug;
        $save->type = $this->type ? $this->type : 0;
        $save->status = $this->status;
        $save->category_id = $this->category_id;
        $save->parent_id = $this->parent_id ? $this->parent_id : 0;
        $save->updated_by = auth()->user()->id;
        $save->save();

        Cache::flush("menu-$save->slug");

        session()->flash('message', $this->name.'. Berhasil ditambahkan!');
        return redirect()->route('menus.index');
    }
    public function editStatus(ModelMenu $data)
    {
        $this->dispatchBrowserEvent('show-status');

        $this->data = $data;
    }

    public function updateStatus()
    {
        $this->data->update([
            'status'=> false,
        ]);

        Cache::flush('menu-'.$this->data->slug);

        $this->dispatchBrowserEvent('hide-status');
        session()->flash('message', $this->data->name.'. Berhasil dihapus!');
    }


    public function deleteMenu()
    {
        $this->data->delete();
        Cache::flush('menu-'.$this->data->slug);

        $this->dispatchBrowserEvent('hide-status');
        session()->flash('message', $this->data->name.'. Berhasil dihapus!');
    }

    public function moveUp($id)
    {
        $row = ModelMenu::findOrFail($id);
        $data = $row->order - 1;

        if($row->parent_id){
            DB::table('menus')->where('parent_id', $row->parent_id)->where('order',$data)->increment('order');
            DB::table('menus')->where('parent_id', $row->parent_id)->where('id', $id)->decrement('order');
        }else{
            DB::table('menus')->where('category_id', 1)->where('order',$data)->increment('order');
            DB::table('menus')->where('category_id', 1)->where('id', $id)->decrement('order');
        }
        Cache::flush("menu-$row->slug");
    }

    public function moveDown($id)
    {
        $row = ModelMenu::findOrFail($id);
        $data = $row->order + 1;

        if($row->parent_id){
            DB::table('menus')->where('parent_id', $row->parent_id)->where('order',$data)->decrement('order');
            DB::table('menus')->where('parent_id', $row->parent_id)->where('id', $id)->increment('order');
        }else{
            DB::table('menus')->where('category_id', 1)->where('order',$data)->decrement('order');
            DB::table('menus')->where('category_id', 1)->where('id', $id)->increment('order');
        }
        Cache::flush("menu-$row->slug");

    }

    public function render()
    {
        $rows = ModelMenu::where('category_id',$this->category_id)->orderBy('parent_id', 'ASC')->orderBy('order', 'ASC')->get();
        $row_category = ModelMenu::where('parent_id', 0)->where('id', '!=', 1)->orderBy('order', 'ASC')->get();
        // dd($row);
        // ->where('status', true)->where('name', 'like','&'.$this->search.'%')
        return view('livewire.menu', [
            'rows' => $rows,
            'row_category' => $row_category,
        ]);
    }
}

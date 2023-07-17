<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceCategoryController extends Controller
{
    public function index()
    {
        return view('admin.services.categories.index');
    }

    public function store(Request $request)
    {
        try{
            $save = new ServiceCategory();
            $save->name = $request->name;
            $save->slug = Str::slug($request->name);
            $save->description = $request->description;
            $save->status = 1;
            $save->parent_id = $request->parent_id;
            $save->created_by = auth()->user()->id;
            $save->save();

            return redirect()->route('servicecategories.index')->with('message', "Kategori $save->name berhasil ditambahkan");
        }catch(Exception $error){
            return redirect()->route('servicecategories.index')->with('message', $error->getMessage());
        }
    }
}

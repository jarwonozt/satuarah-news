<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class TagController extends Controller
{

    public function index()
    {
        return view('admin.tags.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|unique:tags|max:255',
        ]);

        try {
            $save = new Tag();
            $save->title        = $request->title;
            $save->slug         = Str::slug($request->title);
            $save->status       = 1;
            $save->created_by   = auth()->user()->id;
            $save->save();

            return redirect()->route('tags.index')->with('message', "Tag $save->name berhasil ditambahkan");

        } catch (Exception $error) {
            return redirect()->route('tags.index')->with('message', $error->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function newTag(Request $request)
    {
        try {
            $save = new Tag();
            $save->title        = $request->title;
            $save->slug         = Str::slug($request->title);
            $save->status       = 1;
            $save->created_by   = auth()->user()->id;
            $save->save();

            Alert::toast('Tags added successfully !', 'success');
            return back()->withInput();

        } catch (Exception $error) {
            Alert::toast($error->getMessage(), 'success');
        }
    }
}

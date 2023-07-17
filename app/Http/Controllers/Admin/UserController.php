<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Services\ImageServices;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Exception;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{

    public function index()
    {
        return view('admin.users.index');
    }


    public function create()
    {
        $data['roles'] = Role::all();
        return view('admin.users.create', ['data' => $data]);
    }


    public function store(Request $request)
    {
        $validate = $request->validate([
            'name'  => 'required',
            'email' => 'required|unique:users',
            'image' => 'image|mimes:jpeg,png,jpg,gif|dimensions:max_width=1500,max_height:1500',
        ]);

        $image_setting = [
            'ori_width'=>config('app.img_size.ori_width'),
            'ori_height'=>config('app.img_size.ori_height'),
            'mid_width'=>config('app.img_size.mid_width'),
            'mid_height'=>config('app.img_size.mid_height'),
            'thumb_width'=>config('app.img_size.thumb_width'),
            'thumb_height'=>config('app.img_size.thumb_height')
        ];

        $imageName = '';
        if($request->file('image') != null){
            $data = array(
                'skala11' => array(
                    'width'=>$request->input('1_1_width'),
                    'height'=>$request->input('1_1_height'),
                    'x'=>$request->input('1_1_x'),
                    'y'=>$request->input('1_1_y')
                )
            );

            $image_data = [
                'file'=>$request->file('image'),
                'setting'=>$image_setting,
                'path'=>public_path('storage/pictures/users/'),
                'modul'=>'user',
                'data'=>$data
            ];
            $image_service = ImageServices::imageUser($image_data);
            if($image_service['status'] == true){
                $imageName = $image_service['namaImage'];
            }
        }

        $user_type = json_encode($request->user_type);

        if($validate){
            try{
                $user = User::create([
                    'name'          => $request->name,
                    'slug'          => Str::slug($request->name),
                    'email'         => $request->email,
                    'password'      => Hash::make('Bacapolitik@123'),
                    'image'         => $imageName,
                    'status'        => 1,
                    'user_type'     => str_replace(array('[', ']', '"'), '', $user_type),
                    'created_by'    => auth()->user()->id,
                ]);

                $user->assignRole($request->roles);

                // $email_data = array(
                //     'name' => $request->name,
                //     'email' => $request->email,
                //     'password' => $password,
                // );

                // Mail::send('admin.users.welcome_email', $email_data, function ($message) use ($email_data) {
                //     $message->to($email_data['email'], $email_data['name'])
                //         ->subject('Detail Akun Akses CMS Ditjen Bimashindu Kementerian Agama')
                //         ->from(config('app.email'), config('app.name'));
                // });



                return redirect()->route('users.index')->with('message', ucwords($request->name).' | Berhasil ditambahkan!');
            }catch(Exception $error){
                return redirect()->route('users.index')->with('message', $error->getMessage());
            }
        }
    }


    public function show()
    {
        $data['user']           =  User::where('id', auth()->user()->id)->first();
        $data['imagePath']      = 'storage/pictures/users/thumb/'.$data['user']->image;

        return view('admin.users.detail', [
            'data' => $data
        ]);
    }


    public function edit($id)
    {

        $user                   = User::findOrFail($id);
        $user_type              = str_replace(',', '', $user->user_type);

        $data['user']           = $user;
        $data['imagePath']      = 'storage/pictures/users/thumb/'.$user->image;
        $data['roles']          = Role::all();
        $data['current_role']   = str_replace(array('[', ']', '"'), '', $user->getRoleNames());
        $data['user_type']      = str_split($user_type);

        return view('admin.users.edit', ['data' => $data]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif|dimensions:max_width=1500,max_height:1500',
        ]);

        $image_setting = [
            'ori_width'=>config('app.img_size.ori_width'),
            'ori_height'=>config('app.img_size.ori_height'),
            'mid_width'=>config('app.img_size.mid_width'),
            'mid_height'=>config('app.img_size.mid_height'),
            'thumb_width'=>config('app.img_size.thumb_width'),
            'thumb_height'=>config('app.img_size.thumb_height')
        ];

        $imageName = '';
        if($request->file('image') != null){
            $data = array(
                'skala11' => array(
                    'width'=>$request->input('1_1_width'),
                    'height'=>$request->input('1_1_height'),
                    'x'=>$request->input('1_1_x'),
                    'y'=>$request->input('1_1_y')
                )
            );

            $image_data = [
                'file'=>$request->file('image'),
                'setting'=>$image_setting,
                'path'=>public_path('storage/pictures/users/'),
                'modul'=>'user',
                'data'=>$data
            ];
            $image_service = ImageServices::imageUser($image_data);
            if($image_service['status'] == true){
                $imageName = $image_service['namaImage'];
            }
        }

        $user_type = json_encode($request->user_type);
            try{
                $user   = User::findOrFail($id);
                $user->name = $request->name;
                $user->slug = Str::slug($request->name);
                $user->email = $request->email;
                $user->user_type = $user_type ? str_replace(array('[', ']', '"'), '', $user_type) : '';
                $user->updated_by = auth()->user()->id;
                if($imageName){
                    $user->image = $imageName;
                }
                $user->save();

                $user->syncRoles($request->roles);

                return redirect()->route('users.index')->with('message', ucwords($request->name).' | Berhasil diperbaharui!');
            }catch(Exception $error){
                return redirect()->route('users.index')->with('message', $error->getMessage());
            }
    }


    public function updatePassword(Request $request)
    {
        User::where('id', auth()->user()->id)->update([
            'password'      => Hash::make($request->password),
            'updated_by'    => auth()->user()->id,
        ]);

        Alert::success('Berhasil', 'Password berhasil diubah!');

        return back();

    }

    public function updateProfileSetting(Request $request)
    {
        // dd($request);
        $user = User::findOrFail(auth()->user()->id);
        if($request->email != $user->email){
            $user->email_verified_at = null;
            $user->save();
        }

        $request->validate([
                    'image' => 'image|mimes:jpeg,png,jpg,gif|dimensions:max_width=1500,max_height:1500|max:3024',
                ]);

        $image = '';
        if($request->file('image')){
            $data = [
            'file'=>$request->file('image'),
            'path'=>public_path('storage/pictures/users/thumb/'),
            'modul'=>'image'
            ];
            $upload = ImageServices::uploadImage($data);
            if($upload['status'] == true){
                $image = $upload['name'];
            }else{
                return redirect()->route('profile')->with('message', 'Gagal Upload File');
            }
        }


        try{

            $update = User::where('id', auth()->user()->id)->update([
                'name'      => $request->name,
                'email'     => $request->email,
                'image'     => $image != null ? $image : $user->image,
            ]);
        }catch(Exception $error){
            return redirect()->route('profile')->with('message', $error->getMessage());
        }



        return redirect()->route('profile')->with('message', 'Data berhasil diperbaharui!');;

    }

    public function destroy($id)
    {
        //
    }

    public function security()
    {
        $data['user']           =  User::where('id', auth()->user()->id)->first();

        return view('admin.users.security', [
            'data' => $data
        ]);
    }

    public function securityChange(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'current_password' => 'required',
            'new_password' => 'required|confirmed|min:6'
        ]);

        if(!Hash::check($request->current_password, auth()->user()->password)){
            return back()->with("error", "Password saat ini tidak cocok.");
        }

        try{
            User::whereId(auth()->user()->id)->update([
                'password' => Hash::make($request->new_password)
            ]);
            return back()->with('message', 'Password berhasil diubah.');
        }catch(Exception $error){
            return back()->with('error', $error->getMessage());
        }



        return redirect()->route('profile')->with('message', 'Data berhasil diperbaharui!');;

    }
}

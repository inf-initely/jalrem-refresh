<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Alert;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.setting.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|min:3',
            'bio' => 'max:1000'
        ]);

        $user = auth()->user();

        if( $request->has('photo') ) {
            $request->validate([
                'photo' => 'max:10000|mimes:png,jpg,jpeg'
            ]);

            $filename_photo = upload_file('app/public/assets/user', $request->file('photo'));
        } else {
            $filename_photo = $user->photo;
        }

        if( $request->password ) {
            $request->validate([
                'password' => 'min:3|max:255',
                'password_conf' => 'min:3|max:255|same:password',
            ]);

            $password = bcrypt($request->password);
        } else {
            $password = $user->password;
        }

        $user->update([
            'nama' => $request->name,
            'bio' => $request->bio,
            'photo' => $filename_photo,
            'password' => $password
        ]);

        Alert::success('Berhasil', 'User berhasil diedit');

        return redirect()->route('admin.setting.index');

    }
}

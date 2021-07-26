<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('content.auth.login');
    }

    public function login_post(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->route('admin.home');
        }
  
        // return redirect("login")->withError('');

    }

    public function register()
    {
        return view('content.auth.register');
    }

    public function register_post(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'telp' => 'required',
            'contributor' => 'required',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect()->route('admin.home');
    }

    public function create(array $data)
    {
      return User::create([
        'email' => $data['email'],
        'telp' => $data['telp'],
        'contributor' => $data['contributor'],
        'password' => Hash::make($data['password'])
      ]);
    }  
}

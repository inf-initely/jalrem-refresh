<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Models\User;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login()
    {
        return view('content.auth.login');
    }

    public function login_post(Request $request)
    {
        $validate = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'captcha' => 'required|captcha'
        ]);
       
        
        $credentials = $request->only('email', 'password');
        if (auth()->attempt($credentials)) {
            if( !auth()->user()->is_active ) {
                $error = [
                    'message' => 'user was not active'
                ];
                auth()->logout();
                return redirect()->route('login')->withErrors($error);
            }
            return redirect()->route('admin.home');
        }
  
        return redirect()->route('login')->withErrors(['errors' => 'email or password wrong!!']);

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

    public function logout()
    {
        auth()->logout();
        
        return redirect('/login');
    }
}

<?php

namespace App\Http\Controllers;

use Hash;
use Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function showLogin(){
        if(Auth::check()){
            return redirect()->route('dashboard');
        }
        return view('pages.login');
    }

    public function showRegister(){
        if(Auth::check()){
            return redirect()->route('dashboard');
        }
        return view('pages.register');
    }

    public function login(Request $request){

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $data = [
            'email'     => $request->input('email'),
            'password'  => $request->input('password'),
        ];

        Auth::attempt($data);

        if (Auth::check()) { 
    
            return redirect()->route('dashboard');
  
        } else { 
  
            return redirect()->route('login')->with('gagal', 'Email atau password salah');
        }
    }

    public function register(Request $request){
        $request->validate([
            'name' => 'required|unique:users|max:255|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
        ]);

        $user = new User;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $save = $user->save();

        if($save){
            return redirect()->route('login')->with('success', 'Akun berhasil dibuat');
        }
        else{
            return redirect()->route('register')->with('errors', 'Register gagal');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
    


}

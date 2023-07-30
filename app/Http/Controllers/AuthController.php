<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function authenticating(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        //cek login valid
        if (Auth::attempt($credentials)) {

            //$request->session()->regenerate();
            if(Auth::user()->role_id == 1){
                return redirect('dashboard');
            }

            if(Auth::user()->role_id == 2){
                return redirect('home');
            }

        }
        Session::flash('status', 'failed');
        Session::flash('message', 'login invalid');
        return redirect('/login');
    }

    public function registerProcess(Request $request)
    {
        $validated = $request-> validate([
            'username' => 'required|unique:users|max:255',
            'password' => 'required|max:255',
            'phone' => 'max:255',
            'address' => 'required|max:255',
            'role_id' => 'required'
        ]);

        // $validated['role_id']='2';
        $user = User::create($request->all());

        Session::flash('status', 'success');
        Session::flash('message', 'register berhasil');
        return redirect('register');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}


<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function postlogin(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users',
        ]);
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect('/admin/dashboard');
        }
        return redirect('login');
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}

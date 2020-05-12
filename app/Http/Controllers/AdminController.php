<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function login() {
        return view('login');
    }

    public function postLogin(Request $request) {
        $remember = $request->remember ? true : false;
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            return redirect('/home');
        }
        return redirect('admin/login');
    }
}

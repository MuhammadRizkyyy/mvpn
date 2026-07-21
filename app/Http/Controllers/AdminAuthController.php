<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class AdminAuthController extends Controller
{
    public function loginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $username = 'admin';
        $password = 'admin123';

        if (
            $request->username === $username &&
            $request->password === $password
        ) {
            session(['admin' => true]);
            return redirect('/admin/dashboard');
        }

        return back()->with('error', 'Username atau password salah');
    }

    public function logout()
    {
        session()->forget('admin');
        return redirect('/admin/login');
    }
}



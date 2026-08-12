<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AdminAuthController extends Controller
{
    public function loginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $username = config('admin.username');
        $passwordHash = config('admin.password_hash');

        $usernameValid = $username && hash_equals($username, (string) $request->username);
        $passwordValid = $passwordHash && Hash::check((string) $request->password, $passwordHash);

        if ($usernameValid && $passwordValid) {
            $request->session()->regenerate();
            session(['admin' => true]);
            return redirect('/admin/dashboard');
        }

        return back()->with('error', 'Username atau password salah');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('admin');
        $request->session()->regenerate();
        return redirect('/admin/login');
    }
}



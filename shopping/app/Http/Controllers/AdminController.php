<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            return view('home');
        }
        return view('admin.login');
    }

    public function loginAccessed(Request $request)
    {
        $remember = $request->has('remember_me') ? true : false;

        if (auth()->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ], $remember)) {
            return redirect()->to('/admin');
        }
        return redirect()->route('admin.login');
    }

    public function logoutAccess()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}

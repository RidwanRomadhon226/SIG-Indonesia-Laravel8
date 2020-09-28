<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    //   public function __construct()
    //   {
    //     // $this->middleware('role:admin');
    //     $this->middleware('permission:delete post');
    //   }

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->input();
            if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                // Session::put('adminSession', $data['email']);
                if (auth()->user()->hasRole('admin')) {
                    return redirect('/administrator/home')->with('flash_message_success', 'Login out Berhasil');
                } elseif (auth()->user()->hasRole('user')) {
                    return 'anda user';
                }
            } else {
                return redirect('/login')->with('flash_message_error', 'Invalid Username or Password');
            }
        }
        return view('admin.admin_login');
    }

    public function index()
    {
        return view('admin.dashboard');
    }
}

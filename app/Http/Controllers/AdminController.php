<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //   public function __construct()
    //   {
    //     // $this->middleware('role:admin');
    //     $this->middleware('permission:delete post');
    //   }

    public function index()
    {
        // if (!auth()->user()->hasRole('admin')) {
        //     return '404';
        // }
        return 'oke';
    }
}

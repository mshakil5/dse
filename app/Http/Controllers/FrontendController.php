<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        // return view('frontend.index');
        return view('auth.login');
    }

    public function sessionClear()
    {
        session()->flush();
        session()->regenerate();
        return redirect()->back();
    }
}

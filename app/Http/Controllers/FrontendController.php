<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\support\Facades\Auth;

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

    public function switchToUser(Request $request)
    {
        
        $data = User::find(Auth::user()->id);
        $data->is_type = '0';
        if($data->save()){
            return redirect()->route('home');
        }

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\DeterminigAnswer;
use App\Models\Division;
use Illuminate\support\Facades\Auth;
use Illuminate\Http\Request;

class HealthSafetyController extends Controller
{
    public function getAllUsers()
    {
        $users = DeterminigAnswer::where('health_safety_id',Auth::user()->id)->orderby('id', 'DESC')->where('assign_account','=','Health')->get();

        
        return view('expert.userlist', compact('users'));
    }
}

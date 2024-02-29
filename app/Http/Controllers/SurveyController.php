<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function survey()
    {
        return view('user.survey');
    }
}

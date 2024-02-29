<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Division;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function survey()
    {
        $linemanagers = User::where('is_type','2')->select('id', 'name')->get();
        $departments = Department::select('id','name')->get();
        $divisions = Division::select('id','name')->get();
        $questions = Question::with('subquestion')->get();
        // dd($questions);
        return view('user.survey', compact('linemanagers','departments','divisions','questions'));
    }
}

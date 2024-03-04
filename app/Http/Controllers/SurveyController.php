<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Division;
use App\Models\Question;
use App\Models\SubQuestion;
use App\Models\Assesment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Auth;

class SurveyController extends Controller
{
    public function survey()
    {
        $linemanagers = User::where('is_type','2')->select('id', 'name')->get();
        $departments = Department::select('id','name')->get();
        $divisions = Division::select('id','name')->get();
        $questions = Question::with('subquestion')->get();
        $assesment = Assesment::whereUserId(Auth::user()->id)->first();

        // dd($questions);
        return view('user.survey', compact('linemanagers','departments','divisions','questions','assesment'));
    }

    public function determiningQuestion()
    {
        $linemanagers = User::where('is_type','2')->select('id', 'name')->get();
        $departments = Department::select('id','name')->get();
        $divisions = Division::select('id','name')->get();
        $questions = Question::with('subquestion')->get();
        $assesment = Assesment::whereUserId(Auth::user()->id)->first();

        // dd($questions);
        return view('user.determiningqn', compact('linemanagers','departments','divisions','questions','assesment'));
    }
    

    //    search property start

    public function getSubQuery(Request $request){

        $id = $request->id;
        $subqn = SubQuestion::where('question_id', $id)->first();
        
        $prop = '<div class="col-lg-12 mb-4">
                <h6 class="mb-3"><iconify-icon class="text-warning" icon="ci:arrow-sub-down-right"></iconify-icon> '.$request->key.'.1 '.$subqn->question.'</h6>
                <label for="yes" class="mx-2">
                    <input id="yes" type="radio" name="subqn" class="form-check-input me-1"
                        value="yes">Yes
                </label>
                <label for="no" class="mx-2">
                    <input id="no" type="radio" name="subqn" class="form-check-input me-1"
                        value="yes">No
                </label>
            </div>
            <div class="col-lg-12">
                <textarea name="message" class="form-control" placeholder="Comments Here"></textarea>
            </div>
            <div class="col-lg-12">
                <div class="row py-3 ">
                    <div class="col-lg-5 d-flex align-items-center">
                        <small class="text-muted mb-0">76 charachter remaining</small>
                    </div>
                    <div class="col-lg-7 d-flex gap-3 justify-content-end">
                        <button class="btn btn-success d-flex align-items-center"> <iconify-icon
                                icon="akar-icons:check-box-fill" class="me-1"></iconify-icon> accept as
                            resolved</button>
                        <button class="btn btn-warning d-flex align-items-center"> <iconify-icon
                                icon="akar-icons:check-box-fill" class="me-1"></iconify-icon> send
                        </button>
                    </div>
                </div>
            </div>';
        

            return response()->json(['status'=> 303,'subquery'=>$prop,'subqn'=>$subqn]);

        }
    // end search 







}

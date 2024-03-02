<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Division;
use App\Models\Question;
use App\Models\SubQuestion;
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

    //    search property start

    public function getSubQuery(Request $request){

        $id = $request->id;
        $products = SubQuestion::where('question_id', $id)->get();
        
        $prop = '<div class="col-lg-12 mb-4">
                <h6 class="mb-3"><iconify-icon class="text-warning" icon="ci:arrow-sub-down-right"></iconify-icon> 1.1 Is threr enough space for
                    your desk for all of your equipment ?</h6>
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
        

            return response()->json(['status'=> 303,'subquery'=>$prop]);

        }
    // end search 







}

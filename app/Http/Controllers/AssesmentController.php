<?php

namespace App\Http\Controllers;

use App\Models\Assesment;
use App\Models\AssesmentAnswer;
use App\Models\Department;
use App\Models\Division;
use App\Models\Question;
use App\Models\SubQuestion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Auth;

class AssesmentController extends Controller
{

    public function getAssesmentbyLineManager()
    {
        $linemanagers = User::where('is_type','2')->select('id', 'name')->get();
        $departments = Department::select('id','name')->get();
        $divisions = Division::select('id','name')->get();
        $questions = Question::with('subquestion')->get();
        $assesments = Assesment::where('line_manager_id',Auth::user()->id)->pluck('user_id');
        
        $users = User::whereIn('id',$assesments)->get();
        // dd($users);
        return view('manager.assesment', compact('assesments','users'));
    }



    public function assesmentStore(Request $request)
    {

        dd($request->all());

        $chkassesment = Assesment::whereUserId(Auth::user()->id)->first();
        if (isset($chkassesment)) {
            $data = Assesment::find($chkassesment->id);
        } else {
            $data = new Assesment;
            $data->date = date('Y-m-d');
            $data->assesmentid = date('his').Auth::user()->id;
        }
        $data->line_manager_id = $request->line_manager_id;
        $data->department_id = $request->department_id;
        $data->division_id = $request->division_id;
        $data->user_id = Auth::user()->id;
        if ($data->save()) {
            
            






        }else{
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        }
        

    }

    public function assesmentAnswerStore(Request $request)
    {
        // $user = User::findOrFail(Auth::id());

        $assesmnt = Assesment::whereId($request->assesment_id)->first();
        $chkasmnt = AssesmentAnswer::whereUserId(Auth::user()->id)->where('assesment_id', $request->assesment_id)->where('question_id', $request->qid)->first();
        if (isset($chkasmnt)) {
            $data = AssesmentAnswer::find($chkasmnt->id);
        } else {
            $data = new AssesmentAnswer;
            $data->date = date('Y-m-d');
            $data->assesmentid = $assesmnt->assesmentid;
        }
        $data->assesment_id = $request->assesment_id;
        $data->question_id = $request->qid;
        $data->answer = $request->answer;
        $data->user_id = Auth::user()->id;
        if ($data->save()) {

            if ($data->answer == "No") {
                $id = $request->qid;
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


            } else {
            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data Create Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
            }
            
        }else{
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        }
        

    }
}

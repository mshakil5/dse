<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Division;
use App\Models\Question;
use App\Models\Assesment;
use App\Models\Department;
use App\Models\QnCategory;
use App\Models\SubQuestion;
use Illuminate\Http\Request;
use App\Models\AssesmentAnswer;
use App\Models\AssesmentAnswerComment;
use Illuminate\Support\Facades\DB;
use App\Models\WorkStationAssesment;
use Illuminate\support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use PHPUnit\TextUI\Configuration\Php;

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
        // $users = User::all();
        // dd($users);
        // dd($request->all());
        return view('manager.assesment', compact('assesments','users'));
    }



    public function assesmentStore(Request $request)
    {
        

        $messages = [
            'answers.*' => 'Each answer must be either "yes" or "no".',
        ];
        
        $validatedData = $request->validate([
            'answers.*' => 'required',
        ], $messages);
        

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
            
        
            foreach ($request->answers as $question_id => $answer) {
                $chkqncat = Question::whereId($question_id)->first();
                $existingAnswer = AssesmentAnswer::where('user_id', Auth::user()->id)

                ->where('assesment_id', $data->id)
                ->where('question_id', $question_id)
                ->first();

                // dd($existingAnswer);

                if ($existingAnswer) {
                    // Update existing answer
                    $existingAnswer->answer = $answer;
                    $existingAnswer->qn_category_id = $chkqncat->qn_category_id;
                    $existingAnswer->save();
                }
                else{
                    $question = new AssesmentAnswer();
                    $question->date = date('Y-m-d');
                    $question->user_id = Auth::user()->id;
                    $question->assesmentid = $data->assesmentid;
                    $question->assesment_id = $data->id;
                    $question->question_id = $question_id;
                    $question->qn_category_id = $chkqncat->qn_category_id;
                    $question->answer = $answer;
                    $question->save();
                }
            }


            return Redirect::route('user.survey')->with('success', 'Your response successfully saved. Thank you for your response.We will inform you later!!');


        }else{
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        }
        

    }

    public function assesmentAnswerStore(Request $request)
    {
        // $user = User::findOrFail(Auth::id());
        // dd($request->all());

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
             }
             return back()->with('success', 'Your response successfully saved. Thank you for your response.!!');
            
        }else{
             return back()->withInput()->with('error', 'There was an error to store data!!');
        }
        

    }

    public function showAssessmentUserDetails(Request $request, $id)
    {
        $assesment = Assesment::where('user_id', $id)->first();
        $data = WorkStationAssesment::where('user_id', $id)->first();
        $assesmentanswers = AssesmentAnswer::with('assesmentAnswerComments')->where('user_id', $id)->get();
        $userId = $id;
        $questionCategories = QnCategory::withCount(['assesmentAnswers as no_count' => function ($query) use ($userId) {
                            $query->where('answer', 'No')->where('solved','0')->where('user_id', $userId);
                        }])->orderby('no_count','DESC')
                        ->get();
        // dd($questionCategories);
        $user = User::where('id', $id)->first();
        $department = Department::where('id', $assesment->department_id)->first();
        return view('manager.assesment_details', compact('assesment','user','department','data','questionCategories','assesmentanswers'));
    }

    public function showAssessmentUserDetailsbyCategory(Request $request, $uid, $cat_id)
    {
        $assesment = Assesment::where('user_id', $uid)->first();
        $data = WorkStationAssesment::where('user_id', $uid)->first();
        $assesmentanswers = AssesmentAnswer::with('assesmentAnswerComments')->where('user_id', $uid)->where('qn_category_id', $cat_id)->get();

        $questionCategories = QnCategory::withCount(['assesmentAnswers as no_count' => function ($query) {
                            $query->where('answer', 'No');
                        }])->orderby('no_count','DESC')
                        ->get();
        // dd($questionCategories);
        $user = User::where('id', $uid)->first();
        $department = Department::where('id', $assesment->department_id)->first();
        return view('manager.assesment_details', compact('assesment','user','department','data','questionCategories','assesmentanswers'));
    }

    


    //    search property start

    public function getQuestionByCat(Request $request)
    {
        $id = $request->id;
        $user = User::where('id', $request->uid)->first();
        $questions = Question::where('qn_category_id', $id)->get();
        $assesmentanswers = AssesmentAnswer::with('assesmentAnswerComments')->where('qn_category_id', $id)->where('user_id', $user->id)->get();
        
        $prop = '';
            $count = 0;
            foreach ($assesmentanswers as $key => $assanswer) {
                $count = $count + 1;
                if ($assanswer->answer != "Yes") {
                    $prop.= '<div class="row pt-5 px-4">
                        <div class="col-lg-12 mb-4">
                            <h6 class="mb-3">'.$count.'. '.$assanswer->question->question.'</h6>
                            <div class="d-flex">
                                <label for="yes" class="mx-4 fw-bold text-success">
                                    YES <input type="radio" name="answers['.$assanswer->id.']" class="form-check-input" id="yes'.$assanswer->id.'" value="Yes" required="required" ';
                                     if(isset($assanswer->answer)) {
                                        if ($assanswer->answer == 'Yes') {
                                            $prop.= 'checked';
                                        }
                                    } 

                                    $prop.= '></label>
    
                                    <label for="NO" class="me-3 fw-bold text-danger">
                                        NO<input type="radio" name="answers['.$assanswer->id.']" class="form-check-input" value="No" required="required" ';
                                        if(isset($assanswer->answer)) {
                                            if ($assanswer->answer == 'No') {
                                                $prop.= 'checked';
                                            }
                                        } 
                                        
                                    $prop.= '>
                                    </label>
                                </div>
                            </div>';

                            $cmnt = '';
                            foreach ($assanswer->assesmentAnswerComments as $comment) {
                                if ($comment->created_by == "Manager") {
                                    $cmnt.= '<div class="row">
                                                <div class="col-lg-4"></div>
                                                <div class="col-lg-8 p-2 alert alert-secondary mb-3 rounded-3 text-dark text-right">'.$comment->comment.'
                                                    <br>
                                                    <small>Date: '.$comment->date.'</small>
                                                </div>
                                            </div>';
                                } else {
                                    $cmnt.= '<div class="row">
                                                <div class="col-lg-8 p-2 alert alert-secondary mb-3 rounded-3 text-dark text-right">'.$comment->comment.'
                                                    <br>
                                                    <small>Date: '.$comment->date.'</small>
                                                </div>
                                                <div class="col-lg-4"></div>
                                            </div>';
                                }
                            }

                            $prop.= '<form action="" method="POST">

                            <input type="hidden" name="user_id" value="'.$user->id.'">
                            <div class="col-lg-12">
                                <textarea name="manager_comment" class="form-control" placeholder="Comments Here" required></textarea>
                                <input type="hidden" name="assans_id" value="'.$assanswer->id.'">
                            </div>
                            <div class="col-lg-12">
                                <div class="row py-3 ">
                                    <div class="col-lg-5 d-flex align-items-center">
                                    </div>
                                    <div class="col-lg-7 d-flex gap-3 justify-content-end">
                                        <button type="button" id="resolvedBtn" class="btn btn-success d-flex align-items-center"> <iconify-icon icon="akar-icons:check-box-fill" class="me-1"></iconify-icon> accept as resolved</button>
                                        <button type="button" id="sendBtn" class="btn btn-warning d-flex align-items-center"> <iconify-icon icon="akar-icons:check-box-fill" class="me-1"></iconify-icon> send
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form></div>';
                                    
                } 
            }

            foreach ($assesmentanswers as $key => $assanswer) {
                $count = $count + 1;
                if ($assanswer->answer != "No") {
                    $prop.= '<div class="row pt-5 px-4">
                                <div class="col-lg-12 mb-4">
                                    <h6 class="mb-3">'.$count.'. '.$assanswer->question->question.'</h6>
                                    <div class="d-flex">
                                        <label for="yes" class="mx-4 fw-bold text-success"> YES <input type="radio" name="answers['.$assanswer->id.']"  class="form-check-input" id="yes'.$assanswer->id.'" value="Yes" required="required" ';

                                        if(isset($assanswer->answer)) {
                                            if ($assanswer->answer == 'Yes') {
                                                $prop.= 'checked';
                                            }
                                        } 

                                    $prop.= '></label>
    
                                        <label for="NO" class="me-3 fw-bold text-danger"> NO<input type="radio" name="answers['.$assanswer->id.']" class="form-check-input" value="No" required="required" ';

                                        if(isset($assanswer->answer)) {
                                            if ($assanswer->answer == 'No') {
                                                $prop.= 'checked';
                                            }
                                        } 
                                        
                                    $prop.= '>
                                    </label>
                                </div>
                            </div>';
                    
                } 
            }
        return response()->json(['status'=> 303,'question'=>$prop]);
    }
    // end search 


    public function managerCommentStore(Request $request)
    {

        $messages = [
            'manager_comment' => 'Comment required.',
        ];
        
        $validatedData = $request->validate([
            'manager_comment' => 'required',
        ], $messages);
        
        // dd($request->all());
        $data = new AssesmentAnswerComment();
        $data->date = date('Y-m-d');
        $data->line_manager_id = Auth::user()->id;
        $data->comment = $request->manager_comment;
        $data->assesment_answer_id = $request->assans_id;
        $data->user_id = $request->user_id;
        $data->created_by = "Manager";
        if ($data->save()) {
            
            $assesmentans = AssesmentAnswer::find($request->assans_id);
            $assesmentans->solved = "1";
            $assesmentans->save();

            return back()->with('success', 'Your comment successfully saved. Thank you for your response.');
        }else{
            return back()->with('error', 'Server error!!');
        }
    }

    public function managerMessageStore(Request $request)
    {

        if(empty($request->comment)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Comment \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        $data = new AssesmentAnswerComment();
        $data->date = date('Y-m-d');
        $data->line_manager_id = Auth::user()->id;
        $data->comment = $request->comment;
        $data->assesment_answer_id = $request->assans_id;
        $data->user_id = $request->user_id;
        $data->created_by = "Manager";
        if ($data->save()) {
            $assesmentans = AssesmentAnswer::find($request->assans_id);
            $assesmentans->solved = "0";
            $assesmentans->save();
            
            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Comment store Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);

        }else{
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        }
        

    }





    public function userCommentStore(Request $request)
    {

        $messages = [
            'comment' => 'Comment required.',
        ];
        
        $validatedData = $request->validate([
            'comment' => 'required',
        ], $messages);
        
        
        $data = new AssesmentAnswerComment();
        $data->date = date('Y-m-d');
        $data->line_manager_id = $request->line_manager_id;
        $data->comment = $request->comment;
        $data->assesment_answer_id = $request->assans_id;
        $data->user_id = Auth::user()->id;
        $data->created_by = "User";
        if ($data->save()) {
            $assesmentans = AssesmentAnswer::find($request->assans_id);
            $assesmentans->solved = "1";
            $assesmentans->save();
            
            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Comment store Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);

        }else{
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        }
        

    }


}

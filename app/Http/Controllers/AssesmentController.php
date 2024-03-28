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
use App\Models\AssesmentLog;
use App\Models\AssesmentSchedule;
use App\Models\DeterminigAnswer;
use Illuminate\Support\Facades\DB;
use App\Models\WorkStationAssesment;
use Illuminate\support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use PHPUnit\TextUI\Configuration\Php;

class AssesmentController extends Controller
{

    public function getAssesmentbyLineManager()
    {
        // $assesment = Assesment::where('line_manager_id',Auth::user()->id)->pluck('user_id');
        // $assesments = Assesment::where('line_manager_id',Auth::user()->id)->get();
        // $users = User::whereIn('id',$assesment)->get();
        // return view('manager.assesment', compact('assesments','users'));

        $users = DeterminigAnswer::where('line_manager_id',Auth::user()->id)->orderby('id', 'DESC')->where('assign_account','=','Manager')->where('line_manager_notification', 1)->get();
        return view('manager.userlist', compact('users'));
    }



    public function assesmentStore(Request $request)
    {
        
        $messages = [
            'answers.*' => 'Each answer must be either "yes" or "no".',
        ];
        
        $validatedData = $request->validate([
            'answers.*' => 'required',
        ], $messages);
        

        $chkassesment = Assesment::whereUserId(Auth::user()->id)->where('program_number',$request->pnumber)->first();
        if (isset($chkassesment)) {
            $data = Assesment::find($chkassesment->id);
        } else {
            $data = new Assesment;
            $data->date = date('Y-m-d');
            $data->assesmentid = date('his').Auth::user()->id;
            $data->program_number = $request->pnumber;
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
                ->where('program_number', $request->pnumber)
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
                    $question->program_number = $request->pnumber;
                    $question->assesment_id = $data->id;
                    $question->question_id = $question_id;
                    $question->qn_category_id = $chkqncat->qn_category_id;
                    $question->answer = $answer;
                    $question->save();
                }
            }

            $updanswer = DeterminigAnswer::where('program_number', $request->pnumber)->first();
            $updanswer->assign_account = "Manager";
            $updanswer->line_manager_notification = "1";
            $updanswer->user_notification = "0";
            $updanswer->save();


            return Redirect::route('user.survey', $request->pnumber)->with('success', 'Your response successfully saved. Thank you for your response.We will inform you later!!');


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

        
        $assesment = Assesment::where('program_number', $id)->first();
        $data = WorkStationAssesment::where('program_number', $id)->first();
        $assesmentanswers = AssesmentAnswer::with('assesmentAnswerComments')->where('program_number', $id)->get();
        
        $questionCategories = QnCategory::withCount(['assesmentAnswers as no_count' => function ($query) use ($id) {
                            $query->where('answer', 'No')->where('solved','0')->where('program_number', $id);
                        }])->orderby('no_count','DESC')
                        ->get();
                        
        $user = User::where('id', $assesment->user_id)->first();
        $department = Department::where('id', $assesment->department_id)->first();
        $pnumber = $id;
        $catid = '0';
        return view('manager.assesment_details', compact('assesment','user','department','data','questionCategories','assesmentanswers','pnumber','catid'));
    }

    public function showAssessmentUserDetailsbyCategory(Request $request, $uid, $cat_id)
    {
        $assesment = Assesment::where('program_number', $uid)->first();
        $data = WorkStationAssesment::where('program_number', $uid)->first();
        $assesmentanswers = AssesmentAnswer::with('assesmentAnswerComments')->where('program_number', $uid)->where('qn_category_id', $cat_id)->get();

        $questionCategories = QnCategory::withCount(['assesmentAnswers as no_count' => function ($query) use ($uid)  {
                            $query->where('answer', 'No')->where('solved','0')->where('program_number', $uid);
                        }])->orderby('no_count','DESC')
                        ->get();
        // dd($questionCategories);
        $user = User::where('id', $assesment->user_id)->first();
        $department = Department::where('id', $assesment->department_id)->first();
        $pnumber = $uid;
        $catid = $cat_id;
        return view('manager.assesment_details', compact('assesment','user','department','data','questionCategories','assesmentanswers','pnumber','catid'));
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
            $assesmentans->solved = $request->solved;
            $assesmentans->save();
            
            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Comment store Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message,'date'=>$data->date]);

        }else{
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        }
        

    }





    public function userCommentStore(Request $request)
    {

        if(empty($request->comment)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Comment \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        
        $data = new AssesmentAnswerComment();
        $data->date = date('Y-m-d');
        $data->line_manager_id = $request->line_manager_id;
        $data->comment = $request->comment;
        $data->assesment_answer_id = $request->assans_id;
        $data->user_id = Auth::user()->id;
        $data->created_by = "User";
        if ($data->save()) {
            $assesmentans = AssesmentAnswer::find($request->assans_id);
            $assesmentans->solved = $request->solved;
            $assesmentans->save();
            
            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Comment store Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);

        }else{
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        }
        

    }

    public function managerAssesmentApproved(Request $request)
    {
        if(empty($request->comment)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Comment \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        if(empty($request->status)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Status \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        if(empty($request->date)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Date \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        $closeSchedule = AssesmentSchedule::where('program_number',$request->prgmnumber)->first();
        $closeSchedule->status = 1;
        $closeSchedule->status_title = "Approved";
        $closeSchedule->complined = 1;
        $closeSchedule->save();

        $danswer = DeterminigAnswer::where('program_number',$request->prgmnumber)->first();
        $danswer->line_manager_notification = 0;
        $danswer->complined = 1;
        $danswer->save();
       
        // dd($request->all());
        $data = new AssesmentSchedule();
        $data->end_date = $request->date;
        $data->line_manager_id = Auth::user()->id;
        $data->program_number = rand(100000, 9999999);
        $data->user_id = $request->user_id;
        $data->assign_account = "User";
        $data->status = "0";
        $data->created_by = Auth::user()->id;
        if ($data->save()) {

            $logs = new AssesmentLog();
            $logs->date = date('Y-m-d');
            $logs->user_id = $request->user_id;
            $logs->line_manager_id = Auth::user()->id;
            $logs->assesment_schedule_id = $data->id;
            $logs->comment = $request->comment;
            $logs->assign_to = "User";
            $logs->assign_from = "Manager";
            $logs->status_title = "";
            $logs->status = "1";
            $logs->created_by = Auth::user()->id;
            $logs->save();


            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Comment store Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
            
        }else{
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        }
    }

    public function managerAssesmentReject(Request $request)
    {

        if(empty($request->comment)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Comment \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        if(empty($request->status)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Status \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        if(empty($request->date)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Date \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        $danswer = DeterminigAnswer::where('program_number',$request->prgmnumber)->first();
        $danswer->line_manager_notification = 0;
        $danswer->user_notification = 1;
        $danswer->assign_account = "User";
        $danswer->save();
       
        $logs = new AssesmentLog();
        $logs->date = date('Y-m-d');
        $logs->user_id = $request->user_id;
        $logs->line_manager_id = Auth::user()->id;
        $logs->assesment_schedule_id = $danswer->assesment_schedule_id;
        $logs->comment = $request->comment;
        $logs->program_number = $request->program_number;
        $logs->assign_to = "User";
        $logs->assign_from = "Manager";
        $logs->status_title = "";
        $logs->status = "1";
        $logs->created_by = Auth::user()->id;
        if ($logs->save()) {

            $closeSchedule = AssesmentSchedule::where('program_number',$request->prgmnumber)->first();
            $closeSchedule->end_date = $request->date;
            $closeSchedule->status = "2";
            $closeSchedule->save();

            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Comment store Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
            
        }else{
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        }
    }


    public function managerAddRating(Request $request)
    {
        if(empty($request->comment)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Comment \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        if(empty($request->risk_rating_point)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Risk rating number \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        if(empty($request->date)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Next Assesment Date \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        $closeSchedule = AssesmentSchedule::where('program_number',$request->prgmnumber)->first();
        $closeSchedule->status = 1;
        $closeSchedule->risk_rating_point = $request->risk_rating_point;
        $closeSchedule->status_title = "Approved";
        $closeSchedule->save();

        $danswer = DeterminigAnswer::where('program_number',$request->prgmnumber)->first();
        $danswer->line_manager_notification = 0;
        $danswer->complined = 1;
        $danswer->save();
       
        // dd($request->all());
        $data = new AssesmentSchedule();
        $data->end_date = $request->date;
        $data->line_manager_id = Auth::user()->id;
        $data->program_number = rand(100000, 9999999);
        $data->user_id = $request->user_id;
        $data->assign_account = "User";
        $data->status = "0";
        $data->created_by = Auth::user()->id;
        if ($data->save()) {

            $logs = new AssesmentLog();
            $logs->date = date('Y-m-d');
            $logs->user_id = $request->user_id;
            $logs->line_manager_id = Auth::user()->id;
            $logs->assesment_schedule_id = $data->id;
            $logs->program_number = $data->program_number;
            $logs->comment = $request->comment;
            $logs->assign_to = "User";
            $logs->assign_from = "Manager";
            $logs->status_title = "";
            $logs->status = "1";
            $logs->created_by = Auth::user()->id;
            $logs->save();


            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data store Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
            
        }else{
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        }
    }


}

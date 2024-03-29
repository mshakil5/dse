<?php

namespace App\Http\Controllers\Occhealth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assesment;
use App\Models\AssesmentAnswer;
use App\Models\AssesmentAnswerComment;
use App\Models\AssesmentLog;
use App\Models\AssesmentSchedule;
use App\Models\Department;
use App\Models\DeterminigAnswer;
use App\Models\Division;
use App\Models\QnCategory;
use App\Models\User;
use App\Models\WorkStationAssesment;
use Illuminate\support\Facades\Auth;

class OccupationalHealthController extends Controller
{
    public function getAllUsers()
    {
        $users = DeterminigAnswer::where('occupational_health_id',Auth::user()->id)->orderby('id', 'DESC')->whereNull('complined')->get();
        
        return view('expert.userlist', compact('users'));
    }

    public function getComplinedbyOH()
    {
        $users = DeterminigAnswer::where('occupational_health_id',Auth::user()->id)->orderby('id', 'DESC')->where('complined', 1)->get();
        return view('expert.complined', compact('users'));
    }

    public function getUsersDeterminingAnswer($id)
    {
        $departments = Department::select('id','name')->get();
        $divisions = Division::select('id','name')->get();
        $data = DeterminigAnswer::where('id',$id)->first();
        $schedule = AssesmentSchedule::where('program_number', $data->program_number)->first();
        return view('expert.determininguser', compact('data','divisions','departments','schedule'));
    }


    public function showAssessmentUserDetails(Request $request, $id)
    {

        
        $assesment = Assesment::where('program_number', $id)->first();
        $data = WorkStationAssesment::where('program_number', $id)->first();
        $assesmentanswers = AssesmentAnswer::with('assesmentAnswerComments')->where('program_number', $id)->get();
        
        $questionCategories = QnCategory::withCount(['assesmentAnswers as no_count' => function ($query) use ($id) {
                    $query->where('answer', 'No')->where('solved','0')->where('program_number', $id);
                }])->orderby('no_count','DESC')->get();
                        
        $user = User::where('id', $assesment->user_id)->first();
        $department = Department::where('id', $assesment->department_id)->first();
        $pnumber = $id;
        $catid = '0';
        return view('expert.assesment_details', compact('assesment','user','department','data','questionCategories','assesmentanswers','pnumber','catid'));
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
        return view('expert.assesment_details', compact('assesment','user','department','data','questionCategories','assesmentanswers','pnumber','catid'));
    }

    public function addRating(Request $request)
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
        $data->occupational_health_id = Auth::user()->id;
        $data->program_number = rand(100000, 9999999);
        $data->user_id = $request->user_id;
        $data->assign_account = "User";
        $data->status = "0";
        $data->created_by = Auth::user()->id;
        if ($data->save()) {

            $logs = new AssesmentLog();
            $logs->date = date('Y-m-d');
            $logs->user_id = $request->user_id;
            $logs->occupational_health_id = Auth::user()->id;
            $logs->assesment_schedule_id = $data->id;
            $logs->program_number = $data->program_number;
            $logs->comment = $request->comment;
            $logs->assign_to = "User";
            $logs->assign_from = "Health";
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

    public function transferToManager(Request $request)
    {
        if(empty($request->line_manager_id)){
            $message ="<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please Select Line Manager Field.</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        if ($request->prgm) {
            $schedule = AssesmentSchedule::where('program_number', $request->prgm)->first();
            $schedule->line_manager_id = $request->line_manager_id;
            $schedule->assign_account = "Manager";
            $schedule->save();
        }


        $data = DeterminigAnswer::find($request->determiningAnswerId);
        $data->line_manager_id = $request->line_manager_id;
        $data->assign_account = "Manager";
        $data->save();

        if($data->save()){

            $logs = new AssesmentLog();
            $logs->date = date('Y-m-d');
            $logs->user_id = $request->uid;
            $logs->line_manager_id = $request->line_manager_id;
            $logs->assesment_schedule_id = $schedule->id;
            $logs->occupational_health_id = Auth::user()->id;
            $logs->program_number = $request->prgm;
            // $logs->comment = $request->comment;
            $logs->assign_to = "Health";
            $logs->assign_from = "Manager";
            $logs->status_title = "Transfer";
            $logs->status = "1";
            $logs->created_by = Auth::user()->id;
            $logs->save();

            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Schedule create successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }

    }


    public function expertMessageStore(Request $request)
    {

        if(empty($request->comment)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Comment \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        $data = new AssesmentAnswerComment();
        $data->date = date('Y-m-d');
        $data->occupational_health_id = Auth::user()->id;
        $data->comment = $request->comment;
        $data->assesment_answer_id = $request->assans_id;
        $data->user_id = $request->user_id;
        $data->created_by = "Health";
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
}

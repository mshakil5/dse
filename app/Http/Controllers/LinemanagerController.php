<?php

namespace App\Http\Controllers;

use App\Models\AssesmentLog;
use App\Models\AssesmentSchedule;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DeterminigAnswer;
use App\Models\Division;
use Illuminate\Support\Carbon;
use Illuminate\support\Facades\Auth;

class LinemanagerController extends Controller
{
    public function getAllUsers()
    {
        $users = DeterminigAnswer::where('line_manager_id',Auth::user()->id)->orderby('id', 'DESC')->where('assign_account','=','Manager')->where('line_manager_notification', 1)->get();
        return view('manager.userlist', compact('users'));
    }

    public function getUsersDeterminingAnswer($id)
    {
        $departments = Department::select('id','name')->get();
        $divisions = Division::select('id','name')->get();
        $data = DeterminigAnswer::where('id',$id)->first();
        $schedule = AssesmentSchedule::where('program_number', $data->program_number)->first();
        return view('manager.determininguser', compact('data','divisions','departments','schedule'));
    }

    public function addNewSchedule(Request $request)
    {


        if(empty($request->date)){
            $message ="<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill Date field.</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        if ($request->prgmnumber) {
            $oldSchedule = AssesmentSchedule::where('program_number', $request->prgmnumber)->where('line_manager_id', Auth::user()->id)->first();
            $oldSchedule->status = 1;
            $oldSchedule->save();
        }

        $newschedule = new AssesmentSchedule();
        $newschedule->user_id = $request->uid;
        $newschedule->line_manager_id = Auth::user()->id;
        $newschedule->start_date = $request->date;
        $newschedule->program_number = rand(100000, 9999999);
        $newschedule->assign_account = "Manager";
        $newschedule->save();

        if($newschedule->save()){

            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Schedule create successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }

    }


    public function getComplinedbyLineManager()
    {
        $users = DeterminigAnswer::where('line_manager_id',Auth::user()->id)->orderby('id', 'DESC')->where('complined', 1)->get();
        return view('manager.complined', compact('users'));
    }

    public function getDueAssesment()
    {

        $users = AssesmentSchedule::where('line_manager_id', Auth::user()->id)
                            ->where('end_date', '<=', Carbon::now()->addMonth())
                            ->where('end_date', '>=', Carbon::now())
                            ->orderby('id','DESC')
                            ->get();

        return view('manager.due', compact('users'));
    }

    public function transferToHealth(Request $request)
    {
        if(empty($request->health_id)){
            $message ="<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please Health and safety field.</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        if ($request->prgm) {
            $schedule = AssesmentSchedule::where('program_number', $request->prgm)->first();
            $schedule->health_safety_id = $request->health_id;
            $schedule->assign_account = "Health";
            $schedule->save();
        }


        $data = DeterminigAnswer::find($request->determiningAnswerId);
        $data->health_safety_id = $request->health_id;
        $data->assign_account = "Health";
        $data->save();

        if($data->save()){

            $logs = new AssesmentLog();
            $logs->date = date('Y-m-d');
            $logs->user_id = $request->uid;
            $logs->line_manager_id = Auth::user()->id;
            $logs->assesment_schedule_id = $schedule->id;
            $logs->health_safety_id = $request->health_id;
            $logs->program_number = $request->prgm;
            // $logs->comment = $request->comment;
            $logs->assign_to = "Manager";
            $logs->assign_from = "Health";
            $logs->status_title = "Transfer";
            $logs->status = "1";
            $logs->created_by = Auth::user()->id;
            $logs->save();

            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Schedule create successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }

    }
}

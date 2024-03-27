<?php

namespace App\Http\Controllers;

use App\Models\Assesment;
use App\Models\AssesmentAnswer;
use App\Models\AssesmentSchedule;
use App\Models\Department;
use App\Models\DeterminigAnswer;
use App\Models\Division;
use App\Models\QnCategory;
use App\Models\User;
use App\Models\WorkStationAssesment;
use Illuminate\support\Facades\Auth;
use Illuminate\Http\Request;

class HealthSafetyController extends Controller
{
    public function getAllUsers()
    {
        $users = DeterminigAnswer::where('health_safety_id',Auth::user()->id)->orderby('id', 'DESC')->where('assign_account','=','Health')->get();
        return view('expert.userlist', compact('users'));
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
                        }])->orderby('no_count','DESC')
                        ->get();
                        
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
}

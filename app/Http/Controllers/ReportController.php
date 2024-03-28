<?php

namespace App\Http\Controllers;

use App\Models\Assesment;
use App\Models\AssesmentAnswer;
use App\Models\Department;
use App\Models\DeterminigAnswer;
use App\Models\QnCategory;
use App\Models\User;
use App\Models\WorkStationAssesment;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Auth;

class ReportController extends Controller
{
    // public function getAllAssesmentReportByManagger()
    // {
    //     $users = DeterminigAnswer::where('line_manager_id',Auth::user()->id)->orderby('id', 'DESC')->where('complined', 1)->get();

    //     return view('manager.report', compact('users'));
    // }

    public function getAllAssesmentReportByManagger(Request $request, $id)
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
}

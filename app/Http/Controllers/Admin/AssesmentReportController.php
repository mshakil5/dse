<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Assesment;
use App\Models\AssesmentAnswer;
use App\Models\AssesmentHealthProblem;
use App\Models\AssesmentSchedule;
use App\Models\Department;
use App\Models\DeterminigAnswer;
use App\Models\QnCategory;
use App\Models\User;
use App\Models\WorkStationAssesment;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Auth;

class AssesmentReportController extends Controller
{
    public function getCompiledList()
    {
        $data = DeterminigAnswer::orderby('id', 'DESC')->where('complined', 1)->get();
        return view('admin.report.compiled', compact('data'));
    }

    public function getAssesmentReport(Request $request, $id)
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
        $opms = AssesmentHealthProblem::where('program_number', $id)->first();
        
        $oldschedule = AssesmentSchedule::where('program_number', $id)->first();
        $newschedule = AssesmentSchedule::where('user_id', $assesment->user_id)->latest()->first();

        $comments = AssesmentAnswer::whereHas('assesmentAnswerComments')->where('program_number', $id)->get();

        $category = QnCategory::whereHas('question.assesmentAnswers', function ($query) use ($id) {
            $query->where('program_number', $id);
        })->with(['question' => function ($query) use ($id){
            $query->whereHas('assesmentAnswers', function ($query) use ($id) {
                $query->where('program_number', $id);
            });
            $query->with(['assesmentAnswers' => function ($query) use ($id){
                $query->where('program_number', $id);
            }]);
        }])->get();


        // dd($category);
        return view('admin.report.report', compact('assesment','user','department','data','questionCategories','assesmentanswers','opms','oldschedule','newschedule','comments','category'));

    }
}

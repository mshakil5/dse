<?php

namespace App\Http\Controllers;

use App\Models\Assesment;
use App\Models\AssesmentAnswer;
use App\Models\AssesmentAnswerComment;
use App\Models\AssesmentHealthProblem;
use App\Models\AssesmentSchedule;
use App\Models\Department;
use App\Models\DeterminigAnswer;
use App\Models\Division;
use App\Models\QnCategory;
use App\Models\Question;
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
        $division = Division::where('id', $assesment->division_id)->first();
        $opms = AssesmentHealthProblem::with('assesmentHealthComment')->where('program_number', $id)->first();
        
        $oldschedule = AssesmentSchedule::where('program_number', $id)->first();
        $newschedule = AssesmentSchedule::where('user_id', $assesment->user_id)->latest()->first();

        $comments = AssesmentAnswer::whereHas('assesmentAnswerComments')->where('program_number', $id)->get();;

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

        $healthans = AssesmentAnswer::with('assesmentAnswerComments')->where('program_number', $id)->whereNull('question_id')->get();
        $otheranscmmnts = AssesmentAnswerComment::where('program_number', $id)->whereNull('assesment_answer_id')->get();
        $determiningAnswer = DeterminigAnswer::where('program_number', $id)->first();

        $chkboxitemNone = AssesmentAnswer::where('program_number', $id)->whereIn('catname', ['lowback', 'upperback', 'shoulders', 'arms', 'hand_fingers', 'neck'])->where('result','!=', 'None')->count();
        $exerciseAns = AssesmentAnswer::where('program_number', $id)->whereIn('catname', ['exercise'])->where('answer','!=', 'Yes')->count();
        $texerciseAns = AssesmentAnswer::where('program_number', $id)->whereIn('catname', ['taught_exercise'])->where('answer','!=', 'No')->count();
        $otherqnAns = AssesmentAnswer::where('program_number', $id)->whereIn('catname', ['otherqn'])->where('answer','!=', 'No')->count();

        // dd($comments);
        return view('manager.assesment_report', compact('assesment','user','department','data','questionCategories','assesmentanswers','opms','oldschedule','newschedule','comments','category','healthans','otheranscmmnts','determiningAnswer','chkboxitemNone','exerciseAns','texerciseAns','otherqnAns','division'));

    }
}

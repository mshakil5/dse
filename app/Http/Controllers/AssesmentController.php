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
use Illuminate\Support\Facades\DB;
use App\Models\WorkStationAssesment;
use Illuminate\support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

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

                $existingAnswer = AssesmentAnswer::where('user_id', Auth::user()->id)

                ->where('assesment_id', $data->id)
                ->where('question_id', $question_id)
                ->first();

                // dd($existingAnswer);

                if ($existingAnswer) {
                    // Update existing answer
                    $existingAnswer->answer = $answer;
                    $existingAnswer->save();
                }
                else{
                    $question = new AssesmentAnswer();
                    $question->date = date('Y-m-d');
                    $question->user_id = Auth::user()->id;
                    $question->assesmentid = $data->assesmentid;
                    $question->assesment_id = $data->id;
                    $question->question_id = $question_id;
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

    public function showAssessmentUserDetails($id)
    {

        $assesment = Assesment::where('user_id', $id)->first();
        // dd($assesment);
        $data = WorkStationAssesment::where('user_id', $id)->first();
        // dd($data);
        $user = User::where('id', $id)->first();
        $department = Department::where('id', $assesment->department_id)->first();
        $questionCategories = QnCategory::all();
        // $questions = Question::all();
        // dd($questionCategories,$questions);
        return view('manager.assesment_details', compact('assesment','user','department','data','questionCategories'));
    }

    
    public function getQuestionsByCategory($id) 
    {    
        try {
            $questions = Question::where('qn_category_id', $id)->get();
            // dd($questions);
            return response()->json(['questions' => $questions]);
        } 
        catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


}

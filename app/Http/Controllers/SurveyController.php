<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Division;
use App\Models\Question;
use App\Models\SubQuestion;
use App\Models\Assesment;
use App\Models\DeterminigAnswer;
use App\Models\User;
use App\Models\WorkStationAssesment;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class SurveyController extends Controller
{
    public function survey()
    {
        $determiningans = DeterminigAnswer::whereUserId(Auth::user()->id)->first();
        $departments = Department::whereId($determiningans->department_id)->first();
        $questions = Question::with('subquestion')->get();
        $assesment = Assesment::whereUserId(Auth::user()->id)->first();
        $data = WorkStationAssesment::whereUserId(Auth::user()->id)->first();
        $selectedLineManager = User::whereId($determiningans->line_manager_id)->select('id','name')->first();
        $selectedDivision = Division::whereId($determiningans->division_id)->select('id', 'name')->first();

        // dd($selectedDivision);
        return view('user.survey', compact('departments','questions','assesment','determiningans','data', 'selectedLineManager', 'selectedDivision'));
    }

    public function determiningQuestion()
    {
        $linemanagers = User::where('is_type','2')->select('id', 'name')->get();
        $departments = Department::select('id','name')->get();
        $divisions = Division::select('id','name')->get();
        $questions = Question::with('subquestion')->get();
        $assesment = Assesment::whereUserId(Auth::user()->id)->first();
        $data = DeterminigAnswer::whereUserId(Auth::user()->id)->first();

        // dd($data);
        return view('user.determiningqn', compact('linemanagers','departments','divisions','questions','assesment','data'));
    }

    public function determiningQuestionStore(Request $request)
    {
        

        $validatedData = $request->validate([
            'line_manager' => 'required',
            'department_id' => 'required',
            'division_id' => 'required',
            'work_hour' => ['required', 'in:Yes,No'],
            'wow_system' => ['required', 'in:Yes,No']
        ], [
            'line_manager.required' => 'Please Select a Line manager.',
            'department_id.required' => 'Please Select a department.',
            'division_id.required' => 'Please Select a Division.',
            'work_hour.required' => 'Please, choose an option.',
            'wow_system.required' => 'Please, choose an option.'
        ]);

        $chkDtid = DeterminigAnswer::where('user_id',Auth::user()->id)->first();

        if (isset($chkDtid)) {
            $data = DeterminigAnswer::find($chkDtid->id);
        } else {
            $data = new DeterminigAnswer();
            $data->date = date('Y-m-d');
            $data->user_id = Auth::user()->id;
        }
        
        $data->line_manager_id = $request->line_manager;
        $data->department_id = $request->department_id;
        $data->division_id = $request->division_id;
        $data->work_hour = $request->work_hour;
        $data->wow_system = $request->wow_system;
        if ($data->save()) {
            if ($data->work_hour == "Yes" || $data->wow_system == "Yes") {
                return Redirect::route('user.survey')->with('success', 'Your response successfully saved. Thank you for your response.!!');
            } else {
                return back()->with('success', 'Your response successfully saved. Thank you for your response.!!');
            }
            
            
        } else {

            return back()->with('error', 'There was an error to store data!!');
            
            
        }
        

        // dd($questions);
        return view('user.determiningqn', compact('linemanagers','departments','divisions','questions','assesment','data'));
    }

    public function workStationAssesmentStore(Request $request)
    {
        // dd($request->all());

        $validatedData = $request->validate([
            'work_station_number' => 'required',
            'date' => 'required',
            'job_type' => 'required',
            'software' => 'required',
            'continuous_spell' => ['required', 'in:Yes,No']
        ], [
            'work_station_number.required' => 'Work station number field required.',
            'date.required' => 'Date field required.',
            'continuous_spell.required' => 'Please, choose necessary options.',
            'job_type.required' => 'Please, choose Part time or Full time option.',
            'software.required' => 'Please, select a software which you use.'
        ]);

        $chkDtid = WorkStationAssesment::where('user_id',Auth::user()->id)->first();

        if (isset($chkDtid)) {
            $data = WorkStationAssesment::find($chkDtid->id);
        } else {
            $data = new WorkStationAssesment();
            $data->user_id = Auth::user()->id;
        }
        $data->date = $request->date;
        $data->work_station_number = $request->work_station_number;
        $data->job_type = $request->job_type;
        $data->software = json_encode($request->software);
        $data->continuous_spell = $request->continuous_spell;
        $data->continuous_spell_time = $request->continuous_spell_time;
        $data->part_time_work_hour = $request->part_time_work_hour;
        $data->average_using_dse = $request->average_using_dse;
        $data->others_software = $request->others_software;
        if ($data->save()) {
            
            return back()->with('success', 'Your response successfully saved. Thank you for your response.!!');
           
        } else {

            return back()->withInput()->with('error', 'There was an error to store data!!');
            
        }
        

        // dd($questions);
        return view('user.determiningqn', compact('linemanagers','departments','divisions','questions','assesment','data'));
    }
    

    //    search property start

    public function getSubQuery(Request $request){

        $id = $request->id;
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

        }
    // end search 







}

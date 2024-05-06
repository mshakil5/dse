<?php
  
namespace App\Http\Controllers;

use App\Models\AssesmentAnswer;
use App\Models\AssesmentSchedule;
use App\Models\DeterminigAnswer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Carbon;
use Illuminate\support\Facades\Auth;
  
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('home');

        if (auth()->user()->is_type == '1') {
            return redirect()->route('admin.dashboard');
        }else if (auth()->user()->is_type == '2') {
            return redirect()->route('manager.dashboard');
        }else if (auth()->user()->is_type == '3') {
            return redirect()->route('expert.dashboard');
        }else if (auth()->user()->is_type == '4') {
            return redirect()->route('expertmanager.dashboard');
        }else if (auth()->user()->is_type == '0') {
            return redirect()->route('user.dashboard');
        }else{
            return view('home');
        }

    } 
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome(): View
    {
        return view('admin.dashboard');
    }
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function managerHome(Request $request): View
    {
        

        $dusers = DeterminigAnswer::where('line_manager_id', Auth::user()->id)->where('status', 0)->get();
        $newAssesments = DeterminigAnswer::where('line_manager_id',Auth::user()->id)->whereNull('complined')->orderby('id', 'DESC')->where('line_manager_notification', 1)->where('assign_account','Manager')
                    ->when($request->input('fromDate'), function ($query) use ($request) {
                        $query->whereBetween('date', [$request->input('fromDate'), $request->input('toDate')]);
                    })
                    ->when($request->input('user_id'), function ($query) use ($request) {
                        $query->where("user_id",$request->input('user_id'));
                    })
                    ->get();

        $uid = DeterminigAnswer::where('line_manager_id',Auth::user()->id)->pluck('user_id');
        $userlist = User::whereIn('id', $uid)->get();

        $allAssesments = DeterminigAnswer::where('line_manager_id',Auth::user()->id)->orderby('id', 'DESC')->where('line_manager_notification', 1)
                ->when($request->input('fromDate'), function ($query) use ($request) {
                    $query->whereBetween('date', [$request->input('fromDate'), $request->input('toDate')]);
                })
                ->when($request->input('user_id'), function ($query) use ($request) {
                    $query->where("user_id",$request->input('user_id'));
                })
                ->get();

        $dueAssesment = AssesmentSchedule::where('line_manager_id', Auth::user()->id)->whereNull('compiled_date')
                ->where('end_date', '<=', Carbon::now()->addMonth())
                ->where('end_date', '>=', Carbon::now())
                ->orderby('id','DESC')
                ->count();

        $reviewcount = DeterminigAnswer::where('line_manager_id',Auth::user()->id)->orderby('id', 'DESC')->where('assign_account','=','Manager')->where('line_manager_notification', 1)->count();

        $compiledcount = DeterminigAnswer::where('line_manager_id',Auth::user()->id)->orderby('id', 'DESC')->where('complined', 1)->count();
        
        return view('manager.dashboard', compact('dusers','allAssesments','newAssesments','userlist','dueAssesment','reviewcount','compiledcount'));
    }

    public function userDashboard(): View
    {
        $dateToday = Carbon::now()->toDateString();
        // dd($ldate);
        $assesment = AssesmentSchedule::where('user_id', Auth::user()->id)->where('start_date', '<=', $dateToday)->get();

        $dueRecords = AssesmentSchedule::where('user_id', Auth::user()->id)
                            ->where('end_date', '<=', Carbon::now()->addMonth())
                            ->where('end_date', '>=', Carbon::now())
                            ->orderby('id','DESC')
                            ->first();


        $program_number = AssesmentSchedule::where('user_id', Auth::user()->id)->orderby('id','DESC')->first();
        if (isset($program_number)) {
            $generalanscount = AssesmentAnswer::where('program_number', $program_number->program_number)->whereNotNull('question_id')->count();
            $healthanscount = AssesmentAnswer::where('program_number', $program_number->program_number)->whereNull('question_id')->count();
            // Get the count of each distinct value in the catname column
            $counts = AssesmentAnswer::whereIn('catname', ['lowback', 'upperback', 'neck', 'shoulders', 'arms', 'hand_fingers', 'exercise', 'taught_exercise', 'otherqn'])
                    ->where('program_number', $program_number->program_number)
                    ->groupBy('catname')
                    ->selectRaw('catname, COUNT(*) as count')
                    ->pluck('count', 'catname');
            $numKeys = count($counts);
            $anscount = $generalanscount + $numKeys;
        } else {
            $anscount = 0;
        }

        $allAssesments = DeterminigAnswer::where('user_id',Auth::user()->id)->orderby('id', 'DESC')->get();
        

        return view('user.dashboard', compact('assesment','dueRecords','program_number','anscount','allAssesments'));
    }

    public function expertHome(Request $request): View
    {

        $dusers = DeterminigAnswer::where('occupational_health_id', Auth::user()->id)->where('status', 0)->get();
        $newAssesments = DeterminigAnswer::where('occupational_health_id',Auth::user()->id)->whereNull('complined')->orderby('id', 'DESC')->where('assign_account','Health')->get();

        $uid = DeterminigAnswer::where('occupational_health_id',Auth::user()->id)->pluck('user_id');
        // dd($uid);
        $userlist = User::whereIn('id', $uid)->get();

        $allAssesments = DeterminigAnswer::where('occupational_health_id',Auth::user()->id)->orderby('id', 'DESC')
                ->when($request->input('fromDate'), function ($query) use ($request) {
                    $query->whereBetween('date', [$request->input('fromDate'), $request->input('toDate')]);
                })
                ->when($request->input('user_id'), function ($query) use ($request) {
                    $query->where("user_id",$request->input('user_id'));
                })
                ->get();

        $dueAssesment = AssesmentSchedule::where('occupational_health_id', Auth::user()->id)->whereNull('compiled_date')
                ->where('end_date', '<=', Carbon::now()->addMonth())
                ->where('end_date', '>=', Carbon::now())
                ->orderby('id','DESC')
                ->count();




        return view('expert.dashboard', compact('dusers','allAssesments','newAssesments','userlist','dueAssesment'));
        
    }

    public function expertManagerHome(): View
    {
        return view('expertmanager.dashboard');
    }
}
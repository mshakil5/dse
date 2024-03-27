<?php
  
namespace App\Http\Controllers;

use App\Models\AssesmentSchedule;
use App\Models\DeterminigAnswer;
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
            return redirect()->route('expert.home');
        }else if (auth()->user()->is_type == '4') {
            return redirect()->route('expertmanager.home');
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
    public function managerHome(): View
    {
        $dusers = DeterminigAnswer::where('line_manager_id', Auth::user()->id)->where('status', 0)->get();
        
        
        return view('manager.dashboard', compact('dusers'));
    }

    public function userDashboard(): View
    {
        $dateToday = Carbon::now()->toDateString();
        // dd($ldate);
        $assesment = AssesmentSchedule::where('user_id', Auth::user()->id)->where('start_date', '<=', $dateToday)->where('status', 0)->get();
        return view('user.dashboard', compact('assesment'));
    }

    public function expertHome(): View
    {
        
        return view('expert.dashboard');
    }

    public function expertManagerHome(): View
    {
        return view('expertmanager.dashboard');
    }
}
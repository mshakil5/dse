<?php
  
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\View\View;
  
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
        return view('manager.dashboard');
    }

    public function userDashboard(): View
    {
        return view('user.dashboard');
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
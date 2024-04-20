<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DeterminigAnswer;
use Illuminate\support\Facades\Auth;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $allAssesments = DeterminigAnswer::orderby('id', 'DESC')
                ->when($request->input('fromDate'), function ($query) use ($request) {
                    $query->whereBetween('date', [$request->input('fromDate'), $request->input('toDate')]);
                })
                ->when($request->input('user_id'), function ($query) use ($request) {
                    $query->where("user_id",$request->input('user_id'));
                })
                ->get();
        $userlist = User::select('id', 'name')->whereIn('is_type',[ '0', '2', '3' ])->get();
        return view('admin.search.index', compact('allAssesments','userlist'));
    }
}

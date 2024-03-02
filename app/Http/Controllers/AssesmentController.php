<?php

namespace App\Http\Controllers;

use App\Models\Assesment;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Auth;

class AssesmentController extends Controller
{
    public function assesmentStore(Request $request)
    {

        $chkassesment = Assesment::whereUserId(Auth::user()->id)->first();
        if (isset($chkassesment)) {
            $data = Assesment::find($chkassesment->id);
        } else {
            $data = new Assesment;
            $data->date = date('Y-m-d');
            $data->assesmentid = date('his').Auth::user()->id;
        }
        $data->line_manager_id = $request->line_manager;
        $data->department_id = $request->department_id;
        $data->division_id = $request->division_id;
        $data->user_id = Auth::user()->id;
        if ($data->save()) {
            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data Create Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }else{
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        }
        

    }
}

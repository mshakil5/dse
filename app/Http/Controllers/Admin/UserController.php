<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Division;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $data = User::where('is_type', '0')->orderby('id','DESC')->get();
        $linemanagers = User::select('id','name','email')->where('is_type', '2')->orderby('id','DESC')->get();
        $departments = Department::select('id', 'name')->get();
        $devisions = Division::select('id', 'name')->get();
        return view('admin.user.index', compact('data','linemanagers','departments','devisions'));
    }

    public function store(Request $request)
    {
        if(empty($request->name)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Username \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->email)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Email \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->phone)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Phone \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        // if(empty($request->line_manager)){
        //     $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Line manager \" field..!</b></div>";
        //     return response()->json(['status'=> 303,'message'=>$message]);
        //     exit();
        // }
        // if(empty($request->division_id)){
        //     $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Division \" field..!</b></div>";
        //     return response()->json(['status'=> 303,'message'=>$message]);
        //     exit();
        // }
        // if(empty($request->department_id)){
        //     $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Department \" field..!</b></div>";
        //     return response()->json(['status'=> 303,'message'=>$message]);
        //     exit();
        // }
        if(empty($request->password)){            
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Password\" field..!</b></div>"; 
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(isset($request->password) && ($request->password != $request->confirm_password)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Password doesn't match.</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        $chkemail = User::where('email',$request->email)->first();
        if($chkemail){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>This email already added.</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        $data = new User;
        $data->name = $request->name;
        $data->surname = $request->surname;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->house_number = $request->house_number;
        $data->street_name = $request->street_name;
        $data->town = $request->town;
        $data->line_manager = $request->line_manager;
        $data->department_id = $request->department_id;
        $data->division_id = $request->division_id;
        $data->is_type = "0";
        $data->postcode = $request->postcode;
        if(isset($request->password)){
            $data->password = Hash::make($request->password);
        }
        if ($data->save()) {
            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data Create Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }else{
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        }
    }

    public function adminEdit($id)
    {
        $where = [
            'id'=>$id
        ];
        $info = User::where($where)->get()->first();
        return response()->json($info);
    }

    public function update(Request $request)
    {

        
        if(empty($request->name)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Username \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->email)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Email \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->phone)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Phone \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        
        // if(empty($request->line_manager)){
        //     $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Line manager \" field..!</b></div>";
        //     return response()->json(['status'=> 303,'message'=>$message]);
        //     exit();
        // }
        // if(empty($request->division_id)){
        //     $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Division \" field..!</b></div>";
        //     return response()->json(['status'=> 303,'message'=>$message]);
        //     exit();
        // }
        // if(empty($request->department_id)){
        //     $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Department \" field..!</b></div>";
        //     return response()->json(['status'=> 303,'message'=>$message]);
        //     exit();
        // }
        if(isset($request->password) && ($request->password != $request->confirm_password)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Password doesn't match.</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        $duplicateemail = User::where('email',$request->email)->where('id','!=', $request->codeid)->first();
        if($duplicateemail){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>This email already added.</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }


        $data = User::find($request->codeid);
        $data->name = $request->name;
        $data->surname = $request->surname;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->house_number = $request->house_number;
        $data->street_name = $request->street_name;
        $data->town = $request->town;
        $data->postcode = $request->postcode;
        $data->line_manager = $request->line_manager;
        $data->department_id = $request->department_id;
        $data->division_id = $request->division_id;
        if(isset($request->password)){
            $data->password = Hash::make($request->password);
        }
        if ($data->save()) {
            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data Updated Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }
        else{
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        } 
    }

    // public function delete($id)
    // {
    //     $chkagent = Client::where('user_id', $id)->first();
    //     $chktran = Transaction::where('user_id', $id)->first();
    //     $chkloan = Loan::where('user_id', $id)->first();

    //     if (isset($chkagent) || isset($chktran) || isset($chkloan)) {

    //         return response()->json(['success'=>true,'message'=>'This agent have transaction. Do not delete this agent..']);

    //     } else {
    //         if(User::destroy($id)){
    //             return response()->json(['success'=>true,'message'=>'Agent has been deleted successfully']);
    //         }else{
    //             return response()->json(['success'=>false,'message'=>'Delete Failed']);
    //         }
    //     }
        

        
    // }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QnCategory;
use App\Models\Question;
use App\Models\QuestionImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function index()
    {
        $cats = QnCategory::orderby('id','DESC')->get();
        $data = Question::orderby('id','DESC')->get();
        return view('admin.question.index', compact('data','cats'));
    }

    public function store(Request $request)
    {
        if(empty($request->qn_category_id)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Category \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        if(empty($request->question)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"question \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        
        $data = new Question;
        
        // image
        // if ($request->image != 'null') {
        //     $request->validate([
        //         'image' => 'required|mimes:jpeg,png,jpg,gif,svg,pdf|max:8048',
        //     ]);
        //     $rand = mt_rand(100000, 999999);
        //     $imageName = time(). $rand .'.'.$request->image->extension();
        //     $request->image->move(public_path('images/question'), $imageName);
        //     $data->image = $imageName;
        // }
        // end

        $data->question = $request->question;
        $data->type = $request->type;
        $data->tips = $request->tips;
        $data->qn_category_id = $request->qn_category_id;
        $data->created_by = Auth::user()->id;
        if ($data->save()) {

            if ($request->image) {
                // $media= [];
                foreach ($request->image as $image) {
                    $rand = mt_rand(100000, 999999);
                    $name = time() . "_" . Auth::id() . "_" . $rand . "." . $image->getClientOriginalExtension();
                    //move image to postimages folder
                    $image->move(public_path() . '/images/question/', $name);
                    //insert into picture table
                    $pic = new QuestionImage();
                    $pic->image = $name;
                    $pic->question_id = $data->id;
                    $pic->created_by = Auth::user()->id;
                    $pic->save();
                }
            }


            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data Create Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }else{
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        }
    }

    public function edit($id)
    {
        $where = [
            'id'=>$id
        ];
        $info = Question::where($where)->get()->first();
        return response()->json($info);
    }

    public function update(Request $request)
    {

        
        if(empty($request->qn_category_id)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Category \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        if(empty($request->question)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"question \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }


        $data = Question::find($request->codeid);
        // image
        // if ($request->image != 'null') {
        //     $request->validate([
        //         'image' => 'required|mimes:jpeg,png,jpg,gif,svg,pdf|max:8048',
        //     ]);
        //     $rand = mt_rand(100000, 999999);
        //     $imageName = time(). $rand .'.'.$request->image->extension();
        //     $request->image->move(public_path('images/question'), $imageName);
        //     $data->image = $imageName;
        // }
        // end
        
        $data->question = $request->question;
        $data->tips = $request->tips;
        $data->type = $request->type;
        $data->qn_category_id = $request->qn_category_id;
        $data->updated_by = Auth::user()->id;
        if ($data->save()) {


            if ($request->image) {
                // $media= [];
                foreach ($request->image as $image) {
                    $rand = mt_rand(100000, 999999);
                    $name = time() . "_" . Auth::id() . "_" . $rand . "." . $image->getClientOriginalExtension();
                    //move image to postimages folder
                    $image->move(public_path() . '/images/question/', $name);
                    //insert into picture table
                    $pic = new QuestionImage();
                    $pic->image = $name;
                    $pic->question_id = $data->id;
                    $pic->created_by = Auth::user()->id;
                    $pic->save();
                }
            }




            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data Updated Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }
        else{
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        } 
    }

    public function delete($id)
    {

        if(Question::destroy($id)){
            return response()->json(['success'=>true,'message'=>'Data has been deleted successfully']);
        }else{
            return response()->json(['success'=>false,'message'=>'Delete Failed']);
        }
    }
}

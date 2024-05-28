<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Division;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function userProfile()
    {
        
        $linemanagers = User::where('is_type','2')->select('id', 'name')->get();
        $departments = Department::select('id','name')->get();
        $divisions = Division::select('id','name')->get();
        return view('user.profile', compact('linemanagers','departments','divisions'));
    }

    public function userProfileUpdate(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:25',
            'surname' => 'required|string|max:255',
            'phone' => 'required|numeric|digits:11',
            'email' => 'required|email|unique:users,email,' . Auth::user()->id,
            'address_first_line' => 'required|string|max:255',
            'address_second_line' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postcode' => 'required|string|max:255',
            'department_id' => 'required|integer',
            'division_id' => 'required|integer',
            'line_manager' => 'required|integer',
            'password' => 'required|string|max:255',
            'confirm_password' => 'required|same:password',
        ]);

        $data = User::find(Auth::user()->id);
        $data->name = $request->name;
        $data->surname = $request->surname;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->address_first_line = $request->address_first_line;
        $data->address_second_line = $request->address_second_line;
        $data->city = $request->city;
        $data->postcode = $request->postcode;
        $data->line_manager = $request->line_manager;
        $data->department_id = $request->department_id;
        $data->division_id = $request->division_id;
        if(isset($request->password)){
            $data->password = Hash::make($request->password);
        }
        if ($data->save()) {
            return back()->with('success', 'Your information updated successfully.');
        }
        else{
            return back()->with('error', 'An error occurred while creating the user.');
        } 
    }
}

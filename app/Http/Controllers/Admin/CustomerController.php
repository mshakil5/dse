<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\User;
use App\Models\Customer;
use App\Models\Country;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function customerCreate()
    {
        $data = Client::orderby('id','DESC')->get();
        $agents = User::where('is_type','2')->get();
        $countries = Country::orderby('id','DESC')->get();
        return view('admin.customer.index', compact('data','agents','countries'));
    }
}

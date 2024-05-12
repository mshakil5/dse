<?php

namespace App\Http\Controllers;

use App\Models\SupportRequest;
use Illuminate\Http\Request;

class SupportRequestController extends Controller
{
    public function supportRequest()
    {
        return view('supportRequest');
    }

    public function supportRequestSafety()
    {
        return view('supportRequestSafety');
    }

    public function supportRequestStore(Request $request)
    {

        $data = $request->all();
        // Create a new user record in the database
        $user = SupportRequest::create($data);
        return redirect('home');
    }

    public function policyDocument()
    {
        return view('policyDocument');
    }

}

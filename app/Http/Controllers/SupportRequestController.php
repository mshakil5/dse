<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupportRequestController extends Controller
{
    public function supportRequest()
    {
        return view('supportRequest');
    }

    public function supportRequestStore(Request $request)
    {


        dd($request->all());

    }
}

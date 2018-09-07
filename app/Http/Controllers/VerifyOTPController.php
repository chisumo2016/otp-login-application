<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class VerifyOTPController extends Controller
{
    //

    public function  verify(Request $request)
    {
         //dd(request());
        if (request('OTP') === Cache::get('OTP'))
        {
            auth()->user()->update(['isVerified' => true]);
            return redirect('/home');
           // return response(null, 201);
        }

    }

    public function  ShowVerifyForm()
    {
        return view('OTP.verify');
    }
}

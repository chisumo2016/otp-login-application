<?php

namespace App\Http\Controllers;

use App\Http\Requests\OTPRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class VerifyOTPController extends Controller
{
    //

    public function  verify(OTPRequest $request)
    {
        //dd(request('OTP'));   if (request('OTP') === Cache::get('OTP'))
        if (request('OTP') == auth()->user()->OTP())
        {
            auth()->user()->update(['isVerified' => true]);
            return redirect('/home');
           // return response(null, 201);
        }
        return back()->withErrors('OTP is expired or invalid');

    }

    public function  ShowVerifyForm()
    {
        return view('OTP.verify');
    }
}

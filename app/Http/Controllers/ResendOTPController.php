<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResendOTPRequest;


class ResendOTPController extends Controller
{
    //
    public function  resend(ResendOTPRequest $request)
    {
        //dd(request('via'));
        //resend otp
        //cache otp
        //redirect back with msg
        //return response(null, 201);
        auth()->user()->sendOPT($request->via);
        return back()->with('Message', 'Your new OTP is sent, please check !');

    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResendOTPRequest;


class ResendOTPController extends Controller
{
    //
    public function  resend(ResendOTPRequest $request)
    {
        //resend otp
        //cache otp
        //redirect back with msg
         return response(null, 201);
    }
}

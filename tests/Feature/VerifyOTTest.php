<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VerifyOTTest extends TestCase
{
    use DatabaseMigrations;
    /**
     *
     *
     *
     * @test
     */

    public  function  a_user_can_submit_otp_and_Get_verified()
    {
        //$this->withExceptionHandling();
        /*$user = factory(User::class)->create();
        $this->actingAs($user);*/
        $this->logInUser();
        $OTP = auth()->user()->cacheTheOTP();
        $this->post('/verifyOTP', [auth()->user()->OTPKey() =>$OTP])->assertStatus(201);
        $this->assertDatabaseHas('users', ['isVerified' => 1]);
    }




}

/*$OTP = rand(100000, 999999);
Cache::put(['OTP'=> $OTP],now()->addSecond(20));*/
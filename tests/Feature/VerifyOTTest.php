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
        $this->post('/verifyOTP', ['OTP' =>$OTP])->assertStatus(302);
        //$this->post('/verifyOTP', [auth()->user()->OTPKey() =>$OTP])->assertStatus(302);
        $this->assertDatabaseHas('users', ['isVerified' => 1]);
    }

    /*
    *
    *@test
     */

    public function  user_can_see_opt_verify_page()
    {
        $this->logInUser();
        $this->get('/verifyOTP')
            ->assertStatus(200)
            ->assertSee('Enter OTP');
    }
}



/*$OTP = rand(100000, 999999);
Cache::put(['OTP'=> $OTP],now()->addSecond(20));*/
<?php

namespace Tests\Feature;

use App\Mail\OTPMail;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmailTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @test
     */
    public function an_otp_mail_is_send_when_user_is_logged_in()
    {
        Mail::fake();
        $this->withExceptionHandling();
        $user = factory(User::class)->create();
        $res= $this->post('/login',['email' => $user->email,'password'=>'secret']);
        Mail::assertSent(OTPMail::class);

        //$res->assertRedirect('/');

    }



    /**
     * A basic test example.
     *
     * @test
     */
    public function an_otp_mail_is_not_send_if_credentials_are_incorrect()
    {
        Mail::fake();
        //$this->withExceptionHandling();
        $user = factory(User::class)->create();
        $res= $this->post('/login',['email' => $user->email,'password'=>'wshhhdhhdhdhd']);
        Mail::assertNotSent(OTPMail::class);

        //$res->assertRedirect('/');

    }

    /**
     * A basic test example.
     *
     * @test
     */
    public function otp_is_stored_in_cache_for_the_user()
    {

        $user = factory(User::class)->create();
        $res= $this->post('/login',['email' => $user->email,'password'=>'secret']);
        $this->assertNotNull($user->OTP());

    }
}

<?php

namespace Tests\Unit;

use App\Notifications\OTPNotification;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function it_has_cache_key_for_otp()
    {
       $user = factory(User::class)->create();
       $this->assertEquals($user->OTPKey(), 'OTP_for_1');
       //dd($user->OTPKey());
    }


    /**
     * @test
     */
    public function it_can_send_a_OTP_notification_to_the_user()
    {
        $user = factory(User::class)->create();
        Notification::fake();
       $user->sendOTP('via_sms');
       Notification::assertSentTo([$user], OTPNotification::class);
    }
}

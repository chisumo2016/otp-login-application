<?php

namespace Tests\Feature;

use App\Notifications\OTPNotification;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ResendOTPTest extends TestCase
{
    use DatabaseMigrations;
  /*
   * @test
   *
   * */
  public function a_user_can_request_for_new_opt()
  {
      $user = $this->logInUser();
      $this->get('/verifyOTP');
      $response = $this->post('/resend_otp', ['via' => 'email']);
      $response->assertRedirect('/verifyOTP');
      //$response->assertStatus(302);
  }

  /*
   *
   * @test
  */
    public  function a_otp_notification_is_send_when_user_request_new_otp()
    {
        Notification::fake();
        $user = $this->logInUser();
        $response = $this->post('/resent_otp', ['via' => 'email']);
        Notification::assertSendTo([$user], OTPNotification::class);
    }
}
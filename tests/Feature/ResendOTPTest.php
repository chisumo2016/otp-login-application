<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Cache;
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
      $response = $this->post('/resent_otp', ['via' => 'email']);
      $response->assertStatus(201);
  }
}
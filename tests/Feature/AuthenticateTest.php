<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class AuthenticateTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /** @test */
    public function register_an_user()
    {
        $response = $this->post('register', [
            'name' => 'Test',
            'email' => 'test@gmail.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        $response->assertOk();

        $this->assertCount(1, User::all());
    }

    /** @test */
    public function login_an_user()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $response = $this->post('login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertOk();

        $this->assertCount(1, User::all());
    }
}

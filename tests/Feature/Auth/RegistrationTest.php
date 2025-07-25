<?php

namespace Tests\Feature\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_users_can_register(): void
    {
        $role = \App\Models\Role::factory()->create();

        $response = $this->post('/register', [
            'first_name' => 'test',
            'last_name' => 'test',
            'username' => 'testuser',
            'phone' => '1234567890',
            'email' => 'testtest@gmail.com',
            'password' => '12345678',
            'password_confirmation' => '12345678',
            'role_id' => 2,
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('verification.notice'));
    }
}

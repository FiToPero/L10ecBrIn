<?php

namespace Tests\Feature\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

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
            'role_name' => 'welcome_product',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }
}

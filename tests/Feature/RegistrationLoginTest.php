<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class RegistrationLoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_registered_user_can_subsequently_log_in(): void
    {
        $response = $this->post('/register', [
            'name' => 'Nuevo Huésped',
            'email' => 'nuevo@resort.com',
            'password' => 'secret123',
            'age' => 22,
        ]);

        $response->assertRedirect(route('panel'));

        Auth::logout();

        // Intento de login posterior
        $loginResponse = $this->post('/login', [
            'email' => 'nuevo@resort.com',
            'password' => 'secret123',
        ]);

        $loginResponse->assertRedirect(route('panel'));
        $this->assertAuthenticated();
    }
}


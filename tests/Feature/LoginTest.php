<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_seeded_users_can_authenticate_via_credentials(): void
    {
        $this->seed(DatabaseSeeder::class);

        // Intento de login de admin
        $this->assertTrue(Auth::attempt([
            'email' => 'admin@resort.com',
            'password' => 'password',
        ]), 'Admin failed to authenticate with password');

        // Intento de login de adulto
        $this->assertTrue(Auth::attempt([
            'email' => 'adulto@resort.com',
            'password' => 'password',
        ]), 'Adult failed to authenticate with password');

        // Intento de login de menor
        $this->assertTrue(Auth::attempt([
            'email' => 'menor@resort.com',
            'password' => 'password',
        ]), 'Underage failed to authenticate with password');
    }
}


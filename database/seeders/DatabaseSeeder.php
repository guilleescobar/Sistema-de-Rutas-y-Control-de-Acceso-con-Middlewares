<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Administrador mayor de edad
        User::updateOrCreate(
            ['email' => 'admin@resort.com'],
            [
                'name' => 'Carlos Mendoza (Director General)',
                'password' => Hash::make('password'),
                'is_admin' => true,
                'age' => 45,
            ]
        );

        // 2. Usuario normal mayor de edad
        User::updateOrCreate(
            ['email' => 'adulto@resort.com'],
            [
                'name' => 'Valeria Castillo (Huésped Adulta)',
                'password' => Hash::make('password'),
                'is_admin' => false,
                'age' => 26,
            ]
        );

        // 3. Usuario normal menor de edad
        User::updateOrCreate(
            ['email' => 'menor@resort.com'],
            [
                'name' => 'Mateo Fernández (Huésped Menor)',
                'password' => Hash::make('password'),
                'is_admin' => false,
                'age' => 16,
            ]
        );
    }
}

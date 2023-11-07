<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Juan',
            'email' => 'juan@gmail.com',
            'password' => '12345678',
        ]);
        User::create([
            'name' => 'Maria',
            'email' => 'maria@gmail.com',
            'password' => 'password123',
        ]);

        User::create([
            'name' => 'Pedro',
            'email' => 'pedro@gmail.com',
            'password' => 'password123',
        ]);

        User::create([
            'name' => 'Ana',
            'email' => 'ana@gmail.com',
            'password' => 'password123',
        ]);

        User::create([
            'name' => 'Luis',
            'email' => 'luis@gmail.com',
            'password' => 'password123',
        ]);

        User::create([
            'name' => 'Sofia',
            'email' => 'sofia@gmail.com',
            'password' => 'password123',
        ]);

        User::create([
            'name' => 'Carlos',
            'email' => 'carlos@gmail.com',
            'password' => 'password123',
        ]);

        User::create([
            'name' => 'Laura',
            'email' => 'laura@gmail.com',
            'password' => 'password123',
        ]);

        User::create([
            'name' => 'Jorge',
            'email' => 'jorge@gmail.com',
            'password' => 'password123',
        ]);

        User::create([
            'name' => 'Marta',
            'email' => 'marta@gmail.com',
            'password' => 'password123',
        ]);
    }
}

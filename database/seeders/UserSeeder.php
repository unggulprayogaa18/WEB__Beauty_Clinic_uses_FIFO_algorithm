<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'username' => 'admin',
            'password' => '1',
            'role' => 'admin',
        ]);

        User::create([
            'username' => 'manager',
            'password' => '1',
            'role' => 'manager',
        ]);
    }
}

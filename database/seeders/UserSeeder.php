<?php

namespace Database\Seeders;
use Database\Seeders\UserSeeder;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('123456'),
        ]);

        User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'password' => bcrypt('123456'),
        ]);

        User::create([
            'name' => 'Robert Johnson',
            'email' => 'robert@example.com',
            'password' => bcrypt('123456'),
        ]);

        User::create([
            'name' => 'Emily Davis',
            'email' => 'emily@example.com',
            'password' => bcrypt('123456'),
        ]);
    }
}

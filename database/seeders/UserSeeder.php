<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'admin',
                'status' => 'active'
            ],
            [
                'name' => 'User',
                'email' => 'user@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'user',
                'status' => 'active'
            ]
        ];

        User::insert($data);
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'name'=>'Admin',
                'email'=>'admin@gmail.com',
                'password'=>bcrypt('password'),
                'role'=>'admin'
            ],
            [
                'name'=>'User',
                'email'=>'user@gmail.com',
                'password'=>bcrypt('password'),
                'role'=>'user'
            ],
        ];
        foreach ($data as $key => $value) {
            User::create($value);
        }
    }
}

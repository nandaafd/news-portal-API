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
                'name'=>'Nanda',
                'email'=>'nandaafd.info@gmail.com',
                'password'=>bcrypt('nanda123'),
                'role'=>'admin'
            ]
        ];
        foreach ($data as $key => $value) {
            User::create($value);
        }
    }
}

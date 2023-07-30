<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username'=>'admin',
            'password'=>'admin',
            'phone'=>'012345678',
            'address'=>'admin',
            'role_id'=>'1'
        ]);
        User::create([
            'username'=>'customer',
            'password'=>'customer',
            'phone'=>'0234567',
            'address'=>'customer',
            'role_id'=>'2',
        ]);
    }
}

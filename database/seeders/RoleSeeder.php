<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class RoleSeeder extends Seeder
{
    /**
     *@return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Role::truncate();
        Schema::enableForeignkeyConstraints();

        $data = [
            'admin', 'peminjam'
        ];

        foreach ($data as $value){
            Role::insert([
                'name' => $value
            ]);
        }
    }
}

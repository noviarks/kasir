<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'          => 'admin',
            'email'         => 'admin@gmail.com',
            'password'      => Hash::make('admin'),
            'role'          => 'admin'
        ]);

        User::create([
            'name'          => 'kasir',
            'email'         => 'kasir@gmail.com',
            'password'      => Hash::make('kasir'),
            'role'          => 'kasir'
        ]);

    }
}

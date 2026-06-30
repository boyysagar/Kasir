<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Jalankan seeder database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin Restaurant',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Kasir Restaurant',
            'email' => 'kasir@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'kasir',
        ]);
    }
}

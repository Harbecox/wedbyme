<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "email" => "admin@gmail.com",
            'password' => 'password',
            'phone' => "00000000",
            'title' => "admin",
            'role' => User::ROLE_ADMIN
        ]);
    }
}

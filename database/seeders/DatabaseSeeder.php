<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminSeeder::class);
        $this->call(FilterSeeder::class);
        //$this->call(CompanySeeder::class);
        //$this->call(HallSeeder::class);
        //$this->call(ServiceSeeder::class);
        $this->call(HomeSeeder::class);

    }
}


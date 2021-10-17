<?php

namespace Database\Seeders;

use App\Models\Hall;
use App\Models\Home;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;
use Storage;

class HomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Home::create([
            "name"  => "companies",
            "item" => json_encode([],256)
//            "items" => User::all()->random(5)->map(function ($item){
//                return $item->id;
//            })->toArray()
        ]);
        Home::create([
            "name"  => "halls",
            "item" => json_encode([],256)
//            "items" => Hall::all()->random(5)->map(function ($item){
//                return $item->id;
//            })->toArray()
        ]);
        Home::create([
            "name"  => "services",
            "item" => json_encode([],256)
//            "items" => Service::all()->random(5)->map(function ($item){
//                return $item->id;
//            })->toArray()
        ]);
        Home::create([
            "name"  => "slider",
            "item" => json_encode([],256)
//            "items" => collect(Storage::disk("public")->files())->filter(function ($image){
//                return strpos($image,"logo") === false;
//            })
        ]);
    }
}

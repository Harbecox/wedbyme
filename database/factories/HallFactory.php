<?php

namespace Database\Factories;

use App\Models\Hall;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HallFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Hall::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $phones = [];
        for($i = 0;$i < rand(1,3);$i++){
            $phones[] = "+374".$this->faker->numberBetween(10000000,99999999);
        }
        $images = collect(Storage::disk("public")->files('test_data/foto'));
        $images = $images->random($this->faker->numberBetween(1,$images->count()));
        $title = $this->faker->company;
        return [
            "title"     => $title,
            "seo_url"   => Str::slug($title),
            "images"    => $images,
            "coords"    => [40 + $this->faker->randomFloat(5,-0.5,0.5),44 + $this->faker->randomFloat(5,-0.5,0.5)],
            "phones"    => $phones,
            "review"    => $this->faker->randomFloat(1,3,5),
            "address"   => $this->faker->address,
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $logos = Storage::disk("public")->files("test_data/logo");
        $title = $this->faker->company;
        return [
            'email' => $this->faker->unique()->safeEmail(),
            'password' => 'password',
            'phone' => "+374".$this->faker->numberBetween(10000000,99999999),
            "title" => $title,
            "logo" => $this->faker->randomElement($logos),
            "about" => $this->faker->realText(2000),
            "seo_url" => Str::slug($title)
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}

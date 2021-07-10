<?php

namespace Database\Factories;

use App\Models\CalendarDay;
use Illuminate\Database\Eloquent\Factories\Factory;

class CalendarDayFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CalendarDay::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "date" => $this->faker->dateTimeBetween("-1 years"),
            "comment" => $this->faker->numberBetween(0,5) > 4 ? $this->faker->realText(200) : ""
        ];
    }
}

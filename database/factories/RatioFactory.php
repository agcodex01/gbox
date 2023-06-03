<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RatioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'rationable_id' => '1',
            'ratioable_type' => 'App\Models\Product',
            'is' => $this->faker->randomDigitNotZero(),
            'to' => $this->faker->randomDigitNotZero(),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BoardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => '123',
            'type' => 'ASD',
            'width' => 12,
            'heigth' => 12,
            'stocks' => 100
        ];
    }
}

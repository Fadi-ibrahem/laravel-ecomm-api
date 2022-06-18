<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SizeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Available size array
        $sizeArr = ['small', 'medium', 'large', 'x_large', '2_x_large', '3_x_large'];

        return [
            'size_degree'   => $this->faker->randomElement($sizeArr),
        ];
    }
}

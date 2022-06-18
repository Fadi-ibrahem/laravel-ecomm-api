<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code'              => $this->faker->unique()->ean8(),
            'title'             => $this->faker->word(),
            'offer_percentage'  => $this->faker->randomFloat(1, 5, 40),
        ];
    }
}

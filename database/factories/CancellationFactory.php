<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CancellationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date'          => $this->faker->dateTime(),
            'refund_amount' => $this->faker->numberBetween(10, 500),
            'notes'         => $this->faker->text(),
        ];
    }
}

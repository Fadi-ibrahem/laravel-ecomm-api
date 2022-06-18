<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserCustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Get all customer users IDs
        $customersIDs = User::all()->pluck('id')->where('type', '=', 'customer')->toArray();

        return [
            'user_id'   => $this->faker->randomElement($customersIDs),
            'phone'     => $this->faker->phoneNumber(),
            'zone'      => $this->faker->city(),
            'street'    => $this->faker->streetAddress(),
        ];
    }
}

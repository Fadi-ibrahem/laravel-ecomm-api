<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserSupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Get all supplier users IDs
        $suppliersUsersIDs = User::all()->pluck('id')->where('type', '=', 'supplier')->toArray();

        return [
            'user_id'   => $this->faker->randomElement($suppliersUsersIDs),
            'address'   => $this->faker->streetAddress()
        ];
    }
}

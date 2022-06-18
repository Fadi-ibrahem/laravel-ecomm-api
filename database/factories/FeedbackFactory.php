<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\UserCustomer;
use Illuminate\Database\Eloquent\Factories\Factory;

class FeedbackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Get all existing products IDs
        $products = Product::all()->pluck('id')->toArray();

        // Get all existing $customers IDs
        $customers = UserCustomer::all()->pluck('id')->toArray();

        return [
            'rating'        => $this->faker->numberBetween(1, 5),
            'comment'       => $this->faker->text(),
            'product_id'    => $products[rand(0, count($products)-1)],
            'customer_id'   => $products[rand(0, count($customers)-1)],
        ];
    }
}

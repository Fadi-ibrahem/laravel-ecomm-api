<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use App\Models\UserSupplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // All exists supplier IDs
        $suppliers = UserSupplier::all()->pluck('id')->toArray();

        // All exists admins IDs
        $admins = User::all()->where('type', '=', 'admin')->pluck('id')->toArray();

        // All exists Categories IDs
        $categories = Category::all()->pluck('id')->toArray();

        return [
            'name'          => $this->faker->word(),
            'status'        => $this->faker->numberBetween(0, 1),
            'qty'           => $this->faker->numberBetween(1, 50),
            'image'         => $this->faker->imageUrl(70, 70, 'animals', true),
            'description'   => $this->faker->text(),
            'price'         => $this->faker->randomFloat(1, 10, 500),
            'admin_id'      => $this->faker->randomElement($admins),
            'supplier_id'   => $this->faker->randomElement($suppliers),
            'category_id'   => $this->faker->randomElement($categories),
        ];
    }
}

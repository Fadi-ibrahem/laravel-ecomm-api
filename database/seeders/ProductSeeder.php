<?php

namespace Database\Seeders;

use App\Models\Color;
use App\Models\Order;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::factory()
            ->count(10)
            ->has(Color::factory()->count(5))
            ->has(Size::factory()->count(5))
            ->hasAttached(Order::factory()->count(5),
                [   'qty'                           => rand(3, 10),
                    'current_product_price'         => rand(50, 400),
                    'current_total_product_price'   => rand(50, 400)])
            ->create();
    }
}

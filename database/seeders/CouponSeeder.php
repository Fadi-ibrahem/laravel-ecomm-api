<?php

namespace Database\Seeders;

use App\Models\Coupon;
use App\Models\Order;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Coupon::factory()->count(10)->create();
    }
}

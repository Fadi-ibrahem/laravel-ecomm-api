<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            CategorySeeder::class,
            UserSeeder::class,
            UserSupplierSeeder::class,
            UserCustomerSeeder::class,
            ShipperSeeder::class,
            CouponSeeder::class,
            ProductSeeder::class,
            FeedbackSeeder::class,
//            PhoneSeeder::class,
//            OrderSeeder::class,
//            CancellationSeeder::class,
//            ColorSeeder::class,
//            SizeSeeder::class,
        ]);
    }
}

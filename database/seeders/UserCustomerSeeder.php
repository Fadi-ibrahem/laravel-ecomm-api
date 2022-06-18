<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Color;
use App\Models\Feedback;
use App\Models\Order;
use App\Models\Product;
use App\Models\Size;
use App\Models\User;
use App\Models\UserCustomer;
use App\Models\UserSupplier;
use Illuminate\Database\Seeder;

class UserCustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create five users with type customer
        for($i = 0; $i < 5; $i++) {

            // First Create user with type customer
            $user = User::factory()->create(['type'=> 'customer']);

            // Then attach the users and the feedbacks to the users_customers table
            UserCustomer::factory()
                ->for($user)
                ->create();
        }
    }
}

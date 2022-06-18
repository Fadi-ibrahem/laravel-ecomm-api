<?php

namespace Database\Seeders;

use App\Models\Phone;
use App\Models\User;
use App\Models\UserSupplier;
use Illuminate\Database\Seeder;

class UserSupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // First Create users with type supplier
        $users = User::factory()->count(5)->create(['type'=> 'supplier']);

        foreach ($users as $user){
            UserSupplier::factory()->for($user)->hasPhones(2)->create();
        }
    }
}

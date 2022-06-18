<?php

namespace Database\Factories;

use App\Models\Coupon;
use App\Models\Shipper;
use App\Models\UserCustomer;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Order status array
        $orderStatusArr = ['pending', 'shipping', 'accepted', 'rejected', 'cancelled'];

        // All coupons with null value (no coupon option)
        $allCouponsIDs = Coupon::all()->pluck('id')->toArray();
        $allCouponsIDs[] = null;

        // Get all exist shippers IDs
        $shippersIDs = Shipper::all()->pluck('id')->toArray();

        // Get all exist customers IDs
        $customersIDs = UserCustomer::all()->pluck('user_id')->toArray();

        return [
            'order_number'  => $this->faker->unique()->randomNumber(5, true),
            'order_date'    => $this->faker->dateTime(),
            'shipped_date'  => $this->faker->dateTime(),
            'required_date' => $this->faker->dateTime(),
            'qty'           => $this->faker->numberBetween(1, 50),
            'discount'      => $this->faker->randomFloat(1, 10, 40),
            'price'         => $this->faker->numberBetween(10, 500),
            'card_type'     => $this->faker->creditCardType(),
            'card_number'   => $this->faker->creditCardNumber(),
            'tax'           => $this->faker->numberBetween(10, 14),
            'total_price'   => $this->faker->numberBetween(10, 500),
            'status'        => $this->faker->randomElement($orderStatusArr),
            'coupon_id'     => $this->faker->randomElement($allCouponsIDs),
            'shipper_id'    => $this->faker->randomElement($shippersIDs),
            'customer_id'   => $this->faker->randomElement($customersIDs),
        ];
    }
}

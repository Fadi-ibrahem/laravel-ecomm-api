<?php

namespace App\Interfaces\Front;

use App\Models\Coupon;

interface CouponRepositoryInterface
{
    public function index();

    public function create(Array $data);

    public function update(Coupon $coupon, Array $data);

    public function delete(Coupon $coupon);

    public function show(Coupon $coupon);
}

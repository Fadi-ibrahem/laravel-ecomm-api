<?php

namespace App\Repositories\Front;

use App\Filters\Coupon\CouponCodeFilter;
use App\Filters\Coupon\CouponOfferPercentageFilter;
use App\Filters\Coupon\CouponTitleFilter;
use Illuminate\Pipeline\Pipeline;
use App\Interfaces\Front\CouponRepositoryInterface;
use App\Models\Coupon;

class CouponRepository implements CouponRepositoryInterface
{
    public function index()
    {
        $coupons = app(Pipeline::class)
            ->send(Coupon::query())
            ->through([
                CouponCodeFilter::class,
                CouponOfferPercentageFilter::class,
                CouponTitleFilter::class,
            ])
            ->thenReturn()
            ->paginate(12);

        return $coupons;
    }

    public function create(Array $data)
    {
        Coupon::create($data);
    }

    public function update(Coupon $coupon, Array $data)
    {
        $coupon->update($data);
    }

    public function delete(Coupon $coupon)
    {
        $coupon->delete();
    }

    public function show(Coupon $coupon)
    {
        return $coupon;
    }

}

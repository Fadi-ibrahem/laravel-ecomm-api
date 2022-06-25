<?php

namespace App\Http\Controllers\API;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\Front\CouponRepositoryInterface;
use App\Services\API\Coupon\StoreCouponValidationService;
use App\Services\API\Coupon\UpdateCouponValidationService;

class CouponController extends Controller
{
    /**
     * A property to hold the responsible repository for this controller
     * @var CouponRepositoryInterface
     */
    private CouponRepositoryInterface $couponRepo;

    /**
     * @param CouponRepositoryInterface $couponRepo
     */
    public function __construct(CouponRepositoryInterface $couponRepo)
    {
        $this->couponRepo = $couponRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get All Coupons using CouponRepository
        $coupons = $this->couponRepo->index();

        // The response
        return response()->json(compact('coupons'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, StoreCouponValidationService $validator)
    {
        // Validate inputs using external service
        if($errors = $validator->isValid($request)) return response()->json($errors);
        
        // Create new coupon record using CouponRepository
        $this->couponRepo->create($request->all());

        // The response 
        return response()->json("Coupon Created Successfully!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        // Response after model binding
        return response()->json($coupon);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon, UpdateCouponValidationService $validator)
    {
        // Validate inputs using external service
        if($errors = $validator->isValid($request)) return response()->json($errors);
        
        // Update the specific coupon using CouponRepository
        $this->couponRepo->update($coupon, $request->all());

        // The response 
        return response()->json("Coupon Updated Successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        // Delete the specific coupon using CouponRepository
        $this->couponRepo->delete($coupon);

        // The response
        return response()->json("Coupon Deleted Successfully!");
    }
}

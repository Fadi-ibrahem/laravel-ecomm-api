<?php

namespace App\Http\Controllers\API;

use App\Models\Shipper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\Front\ShipperRepositoryInterface;
use App\Services\API\Shipper\AddShipperPhonesValidationService;
use App\Services\API\Shipper\StoreShipperValidationService;
use App\Services\API\Shipper\UpdateShipperValidationService;

class ShipperController extends Controller
{
    /**
     * A property to hold the responsible repository for this controller
     * @var ShipperRepositoryInterface
     */
    private ShipperRepositoryInterface $shipperRepo;

    /**
     * @param ShipperRepositoryInterface $shipperRepo
     */
    public function __construct(ShipperRepositoryInterface $shipperRepo)
    {
        $this->shipperRepo = $shipperRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get All Shippers using ShipperRepository
        $shippers = $this->shipperRepo->index();

        // The response
        return response()->json(compact('shippers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, StoreShipperValidationService $validator)
    {
        // Validate inputs using external service
        if($errors = $validator->isValid($request)) return response()->json($errors);
        
        // Create new shipper record using ShipperRepository
        $this->shipperRepo->create($request->all());

        // The response 
        return response()->json("Shipper Created Successfully!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Shipper $shipper)
    {
        // Response after model binding
        return response()->json($shipper);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shipper $shipper, UpdateShipperValidationService $validator)
    {
        // Validate inputs using external service
        if($errors = $validator->isValid($request)) return response()->json($errors);
        
        // Update the specific shipper using ShipperRepository
        $this->shipperRepo->update($shipper, $request->all());

        // The response 
        return response()->json("Shipper Updated Successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shipper $shipper)
    {
        // Delete the specific shipper using ShipperRepository
        $this->shipperRepo->delete($shipper);

        // The response
        return response()->json("Shipper Deleted Successfully!");
    }


    // Polymorphic Retrieval Phones Function
    public function retrievePhones(Shipper $shipper)
    {
        return response()->json($shipper->phones);
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Models\Phone;
use App\Models\Shipper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\Front\PhoneRepositoryInterface;
use App\Models\UserSupplier;
use App\Services\API\Phone\UpdatePhoneValidationService;
use App\Services\API\Phone\AddShipperPhonesValidationService;
use App\Services\API\Phone\GeneratePhoneModelsService;

class PhoneController extends Controller
{
    /**
     * A property to hold the responsible repository for this controller
     * @var PhoneRepositoryInterface
     */
    private PhoneRepositoryInterface $phoneRepo;

    /**
     * @param PhoneRepositoryInterface $phoneRepo
     */
    public function __construct(PhoneRepositoryInterface $phoneRepo)
    {
        $this->phoneRepo = $phoneRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get All Phones using PhoneRepository
        $phones = $this->phoneRepo->index();

        // The response
        return response()->json(compact('phones'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Phone $phone)
    {
        // Response after model binding
        return response()->json($phone);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Phone $phone, UpdatePhoneValidationService $validator)
    {
        // Validate inputs using external service
        if($errors = $validator->isValid($request)) return response()->json($errors);
        
        // Update the specific phone using PhoneRepository
        $this->phoneRepo->update($phone, $request->phone_number, $request->phoneable_id);

        // The response 
        return response()->json("Phone Updated Successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Phone $phone)
    {
        // Delete the specific phone using PhoneRepository
        $this->phoneRepo->delete($phone);

        // The response
        return response()->json("Phone Deleted Successfully!");
    }


    /**
     * Start Different Polymorphic Insertion Method
     */

    // Add Phones For Shipper
    public function appendPhonesToShipper(Request $request, Shipper $shipper, AddShipperPhonesValidationService $validator)
    {

        // Validate inputs using external service
        if($errors = $validator->isValid($request)) return response()->json($errors);

        $phoneModelsArr = GeneratePhoneModelsService::generatePhoneModels($request->phones);

        // Insert Phones Associated With This Shipper
        $shipper->phones()->saveMany($phoneModelsArr);
        
        return response()->json("Phone Added To Shipper Successfully");
    }

    // Add Phones For Customer
    public function appendPhonesToSupplier(Request $request, $id, AddShipperPhonesValidationService $validator)
    {

        // Validate inputs using external service
        if($errors = $validator->isValid($request)) return response()->json($errors);

        // Generate The proper array
        $phoneModelsArr = GeneratePhoneModelsService::generatePhoneModels($request->phones);

        // Get Supplier
        $supplier = UserSupplier::find($id);

        // Insert Phones Associated With This Supplier
        $supplier->phones()->saveMany($phoneModelsArr);
        
        return response()->json("Phone Added To Supplier Successfully");
    }

    /**
     * End Different Polymorphic Insertion Method
     */
}

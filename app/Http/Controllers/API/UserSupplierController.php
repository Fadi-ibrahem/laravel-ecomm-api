<?php

namespace App\Http\Controllers\API;

use App\Models\UserSupplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\Front\UserSupplierRepositoryInterface;
use App\Services\API\Supplier\UpdateSupplierValidationService;

class UserSupplierController extends Controller
{
    /**
     * A property to hold the responsible repository for this controller
     * @var UserSupplierRepositoryInterface
     */
    private UserSupplierRepositoryInterface $supplierRepo;

    /**
     * @param UserSupplierRepositoryInterface $supplierRepo
     */
    public function __construct(UserSupplierRepositoryInterface $supplierRepo)
    {
        $this->supplierRepo = $supplierRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get All Suppliers using SupplierRepo
        $suppliers = $this->supplierRepo->index();

        // The response
        return response()->json(compact('suppliers'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Check whether the authenticated supplier is authorized to show the sent supplier id
        if(auth('api')->user()->id == $id) {

            $supplier = $this->supplierRepo->show($id);
            return response()->json($supplier);
        }
        return response()->json("You aren't able to show this supplier");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, UpdateSupplierValidationService $validator)
    {
        // Check whether the authenticated supplier is authorized to update the sent supplier id
        if(auth('api')->user()->id == $id){

            // Validate inputs using external service
            if($errors = $validator->isValid($request)) return response()->json($errors);
            
            // Update the specific supplier using SupplierRepo
            $this->supplierRepo->update($id, $request->all());

            // The response 
            return response()->json("Supplier Updated Successfully!");
        }
        return response()->json("You aren't able to update this supplier"); 
    }

    /*
    // Delete only from main users table
    public function destroy($id)
    {
        // Check whether the authenticated supplier is authorized to delete the sent supplier id
        if(auth('api')->user()->id == $id){

            // Delete the specific supplier using SupplierRepo
            $this->supplierRepo->delete($id);

            // The response
            return response()->json("Supplier Deleted Successfully!");
        }
        return response()->json("You aren't able to delete this supplier"); 
    }
    */

    // Polymorphic Retrieval Function
    public function retrievePhones($id)
    {
        $supplier = UserSupplier::where('user_id', $id)->first();
        return response()->json($supplier->phones);
    }
}

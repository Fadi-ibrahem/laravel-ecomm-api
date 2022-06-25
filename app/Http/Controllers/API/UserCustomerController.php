<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\Front\UserCustomerRepositoryInterface;
use App\Services\API\Customer\UpdateCustomerValidationService;

class UserCustomerController extends Controller
{
    /**
     * A property to hold the responsible repository for this controller
     * @var UserCustomerRepositoryInterface
     */
    private UserCustomerRepositoryInterface $customerRepo;

    /**
     * @param UserCustomerRepositoryInterface $customerRepo
     */
    public function __construct(UserCustomerRepositoryInterface $customerRepo)
    {
        $this->customerRepo = $customerRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get All Customers using CustomerRepository
        $customers = $this->customerRepo->index();

        // The response
        return response()->json(compact('customers'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Check whether the authenticated customer is authorized to show the sent customer id
        if(auth('api')->user()->id == $id) {

            $customer = $this->customerRepo->show($id);
            return response()->json($customer);
        }
        return response()->json("You aren't able to show this customer");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, UpdateCustomerValidationService $validator)
    {
        // Check whether the authenticated customer is authorized to update the sent customer id
        if(auth('api')->user()->id == $id){

            // Validate inputs using external service
            if($errors = $validator->isValid($request)) return response()->json($errors);
            
            // Update the specific customer using CustomerRepository
            $this->customerRepo->update($id, $request->all());

            // The response 
            return response()->json("Customer Updated Successfully!");
        }
        return response()->json("You aren't able to update this customer"); 
    }

    /*
    // Delete only from main users table
    public function destroy($id)
    {
        // Check whether the authenticated customer is authorized to delete the sent customer id
        if(auth('api')->user()->id == $id){

            // Delete the specific customer using CustomerRepository
            $this->customerRepo->delete($id);

            // The response
            return response()->json("Customer Deleted Successfully!");
        }
        return response()->json("You aren't able to delete this customer"); 
    }
    */
}

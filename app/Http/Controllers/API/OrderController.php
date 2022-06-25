<?php

namespace App\Http\Controllers\API;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\Front\OrderRepositoryInterface;
use App\Services\API\Order\StoreOrderValidationService;
use App\Services\API\Order\UpdateOrderValidationService;
use App\Services\API\Order\OrderProductsValidationService;

class OrderController extends Controller
{
    /**
     * A property to hold the responsible repository for this controller
     * @var OrderRepositoryInterface
     */
    private OrderRepositoryInterface $orderRepo;

    /**
     * @param OrderRepositoryInterface $orderRepo
     */
    public function __construct(OrderRepositoryInterface $orderRepo)
    {
        $this->orderRepo = $orderRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get All Orders using OrderRepo
        $orders = $this->orderRepo->index();

        // The response
        return response()->json(compact('orders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, StoreOrderValidationService $validator)
    {
        // Validate inputs using external service
        if($errors = $validator->isValid($request)) return response()->json($errors);
        
        // Create new order record using OrderRepo
        $this->orderRepo->create($request->all());

        // The response 
        return response()->json("Order Created Successfully!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        // Response after model binding
        return response()->json($order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order, UpdateOrderValidationService $validator)
    {
        // Validate inputs using external service
        if($errors = $validator->isValid($request)) return response()->json($errors);
        
        // Update the specific order using OrderRepo
        $this->orderRepo->update($order, $request->all());

        // The response 
        return response()->json("Order Updated Successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        // Delete the specific order using OrderRepo
        $this->orderRepo->delete($order);

        // The response
        return response()->json("Order Deleted Successfully!");
    }


    /**
     * Start Many-To-Many Insertion Methods
     */

    public function attachProducts(Request $request, OrderProductsValidationService $validator) {

        // Validate inputs using external service
        if($errors = $validator->isValid($request)) return response()->json($errors);

        // Get the specific order
        $order = Order::findOrFail($request->order_id);        

        // Many-To-Many Insertion with intermediate table custom attributes
        $order->products()->sync($request->products_id);
        
        // The response
        return response()->json("Order Added To Products Successfully!");
    }

    /**
     * End Many-To-Many Insertion Methods
     */
}

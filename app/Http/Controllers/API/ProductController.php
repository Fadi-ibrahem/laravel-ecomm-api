<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\Front\ProductRepositoryInterface;
use App\Services\API\Product\ProductSizesValidationService;
use App\Services\API\Product\StoreProductValidationService;
use App\Services\API\Product\ProductColorsValidationService;
use App\Services\API\Product\ProductOrdersValidationService;
use App\Services\API\Product\UpdateProductValidationService;

class ProductController extends Controller
{
    /**
     * A property to hold the responsible repository for this controller
     * @var ProductRepositoryInterface
     */
    private ProductRepositoryInterface $productRepo;

    /**
     * @param ProductRepositoryInterface $productRepo
     */
    public function __construct(ProductRepositoryInterface $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get All Products using ProductRepository
        $products = $this->productRepo->index();

        // The response
        return response()->json(compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, StoreProductValidationService $validator)
    {
        // Validate inputs using external service
        if($errors = $validator->isValid($request)) return response()->json($errors);
        
        // Create new product record using ProductRepository
        $this->productRepo->create($request);

        // The response 
        return response()->json("Product Created Successfully!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        // Response after model binding
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product, UpdateProductValidationService $validator)
    {
        // Validate inputs using external service
        if($errors = $validator->isValid($request)) return response()->json($errors);
        
        // Update the specific product using ProductRepository
        $this->productRepo->update($product, $request);

        // The response 
        return response()->json("Product Updated Successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        // Delete the specific product using ProductRepository
        $this->productRepo->delete($product);

        // The response
        return response()->json("Product Deleted Successfully!");
    }


    /**
     * Start Many-To-Many Insertion Methods
     */

    public function attachColors(Request $request, ProductColorsValidationService $validator) {

        // Validate inputs using external service
        if($errors = $validator->isValid($request)) return response()->json($errors);

        // Get the specific color
        $product = Product::findOrFail($request->product_id);

        // Many-To-Many Insertion
        $product->colors()->attach($request->colors_id);

        // The response
        return response()->json("Product Added To Colors Successfully!");
    }

    public function attachSizes(Request $request, ProductSizesValidationService $validator) {

        // Validate inputs using external service
        if($errors = $validator->isValid($request)) return response()->json($errors);

        // Get the specific color
        $product = Product::findOrFail($request->product_id);

        // Many-To-Many Insertion
        $product->sizes()->attach($request->sizes_id);

        // The response
        return response()->json("Product Added To Sizes Successfully!");
    }

    public function attachOrders(Request $request, ProductOrdersValidationService $validator) {

        // Validate inputs using external service
        if($errors = $validator->isValid($request)) return response()->json($errors);

        // Get the specific color
        $product = Product::findOrFail($request->product_id);        

        // Many-To-Many Insertion with intermediate table custom attributes
        $product->orders()->sync($request->orders_id);
        
        // The response
        return response()->json("Product Added To Orders Successfully!");
    }

    /**
     * End Many-To-Many Insertion Methods
     */
}

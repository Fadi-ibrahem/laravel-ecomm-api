<?php

namespace App\Http\Controllers\API;

use App\Models\Size;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\Front\SizeRepositoryInterface;
use App\Services\API\Size\StoreSizeValidationService;
use App\Services\API\Size\UpdateSizeValidationService;
use App\Services\API\Size\SizeProductsValidationService;

class SizeController extends Controller
{
    /**
     * A property to hold the responsible repository for this controller
     * @var SizeRepositoryInterface
     */
    private SizeRepositoryInterface $sizeRepo;

    /**
     * @param SizeRepositoryInterface $sizeRepo
     */
    public function __construct(SizeRepositoryInterface $sizeRepo)
    {
        $this->sizeRepo = $sizeRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get All Sizes using SizeRepo
        $sizes = $this->sizeRepo->index();

        // The response
        return response()->json(compact('sizes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, StoreSizeValidationService $validator)
    {
        // Validate inputs using external service
        if($errors = $validator->isValid($request)) return response()->json($errors);
        
        // Create new size record using SizeRepo
        $this->sizeRepo->create($request->all());

        // The response 
        return response()->json("Size Created Successfully!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Size $size)
    {
        // Response after model binding
        return response()->json($size);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Size $size, UpdateSizeValidationService $validator)
    {
        // Validate inputs using external service
        if($errors = $validator->isValid($request)) return response()->json($errors);
        
        // Update the specific size using SizeRepo
        $this->sizeRepo->update($size, $request->all());

        // The response 
        return response()->json("Size Updated Successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Size $size)
    {
        // Delete the specific size using SizeRepo
        $this->sizeRepo->delete($size);

        // The response
        return response()->json("Size Deleted Successfully!");
    }


    /**
     * Start Many-To-Many Insertion Methods
     */

    public function attachProducts(Request $request, SizeProductsValidationService $validator) {

        // Validate inputs using external service
        if($errors = $validator->isValid($request)) return response()->json($errors);

        // Get the specific size
        $size = Size::findOrFail($request->size_id);

        // Many-To-Many Insertion
        $size->products()->attach($request->products_id);

        // The response
        return response()->json("Size Added To Products Successfully!");
    }

    /**
     * End Many-To-Many Insertion Methods
     */
}

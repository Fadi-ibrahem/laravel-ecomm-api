<?php

namespace App\Http\Controllers\API;

use App\Models\Color;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\Front\ColorRepositoryInterface;
use App\Services\API\Color\ColorProductsValidationService;
use App\Services\API\Color\StoreColorValidationService;
use App\Services\API\Color\UpdateColorValidationService;

class ColorController extends Controller
{
    /**
     * A property to hold the responsible repository for this controller
     * @var ColorRepositoryInterface
     */
    private ColorRepositoryInterface $colorRepo;

    /**
     * @param ColorRepositoryInterface $colorRepo
     */
    public function __construct(ColorRepositoryInterface $colorRepo)
    {
        $this->colorRepo = $colorRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get All Colors using ColorRepository
        $colors = $this->colorRepo->index();

        // The response
        return response()->json(compact('colors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, StoreColorValidationService $validator)
    {
        // Validate inputs using external service
        if($errors = $validator->isValid($request)) return response()->json($errors);
        
        // Create new color record using ColorRepository
        $this->colorRepo->create($request->all());

        // The response 
        return response()->json("Color Created Successfully!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Color $color)
    {
        // Response after model binding
        return response()->json($color);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Color $color, UpdateColorValidationService $validator)
    {
        // Validate inputs using external service
        if($errors = $validator->isValid($request)) return response()->json($errors);
        
        // Update the specific color using ColorRepository
        $this->colorRepo->update($color, $request->all());

        // The response 
        return response()->json("Color Updated Successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Color $color)
    {
        // Delete the specific color using ColorRepository
        $this->colorRepo->delete($color);

        // The response
        return response()->json("Color Deleted Successfully!");
    }


    /**
     * Start Many-To-Many Insertion Methods
     */

    public function attachProducts(Request $request, ColorProductsValidationService $validator) {

        // Validate inputs using external service
        if($errors = $validator->isValid($request)) return response()->json($errors);

        // Get the specific color
        $color = Color::findOrFail($request->color_id);

        // Many-To-Many Insertion
        $color->products()->attach($request->products_id);

        // The response
        return response()->json("Color Added To Products Successfully!");
    }

    /**
     * End Many-To-Many Insertion Methods
     */
}

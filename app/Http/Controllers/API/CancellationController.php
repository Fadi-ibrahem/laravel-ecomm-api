<?php

namespace App\Http\Controllers\API;

use App\Models\Cancellation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\Front\CancellationRepositoryInterface;
use App\Services\API\Cancellation\StoreCancellationValidationService;
use App\Services\API\Cancellation\UpdateCancellationValidationService;

class CancellationController extends Controller
{
    /**
     * A property to hold the responsible repository for this controller
     * @var CancellationRepositoryInterface
     */
    private CancellationRepositoryInterface $cancellationRepo;

    /**
     * @param CancellationRepositoryInterface $cancellationRepo
     */
    public function __construct(CancellationRepositoryInterface $cancellationRepo)
    {
        $this->cancellationRepo = $cancellationRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get All Cancellations using cancellationRepository
        $cancellations = $this->cancellationRepo->index();

        // The response
        return response()->json(compact('cancellations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, StoreCancellationValidationService $validator)
    {
        // Validate inputs using external service
        if($errors = $validator->isValid($request)) return response()->json($errors);
        
        // Create new cancellation record using CancellationRepository
        $this->cancellationRepo->create($request->all());

        // The response 
        return response()->json("Cancellation Created Successfully!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Cancellation $cancellation)
    {
        // Response after model binding
        return response()->json($cancellation);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cancellation $cancellation, UpdateCancellationValidationService $validator)
    {
        // Validate inputs using external service
        if($errors = $validator->isValid($request)) return response()->json($errors);
        
        // Update the specific cancellation using CancellationRepository
        $this->cancellationRepo->update($cancellation, $request->all());

        // The response 
        return response()->json("Cancellation Updated Successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cancellation $cancellation)
    {
        // Delete the specific cancellation using CancellationRepository
        $this->cancellationRepo->delete($cancellation);

        // The response
        return response()->json("Cancellation Deleted Successfully!");
    }
}

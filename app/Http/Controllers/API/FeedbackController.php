<?php

namespace App\Http\Controllers\API;

use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\Front\FeedbackRepositoryInterface;
use App\Services\API\Feedback\StoreFeedbackValidationService;
use App\Services\API\Feedback\UpdateFeedbackValidationService;

class FeedbackController extends Controller
{
    /**
     * A property to hold the responsible repository for this controller
     * @var FeedbackRepositoryInterface
     */
    private FeedbackRepositoryInterface $feedbackRepo;

    /**
     * @param FeedbackRepositoryInterface $feedbackRepo
     */
    public function __construct(FeedbackRepositoryInterface $feedbackRepo)
    {
        $this->feedbackRepo = $feedbackRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get All Feedbacks using FeedbackRepository
        $feedbacks = $this->feedbackRepo->index();

        // The response
        return response()->json(compact('feedbacks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, StoreFeedbackValidationService $validator)
    {
        // Validate inputs using external service
        if($errors = $validator->isValid($request)) return response()->json($errors);
        
        // Create new feedback record using FeedbackRepository
        $this->feedbackRepo->create($request->all());

        // The response 
        return response()->json("Feedback Created Successfully!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Feedback $feedback)
    {
        // Response after model binding
        return response()->json($feedback);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feedback $feedback, UpdateFeedbackValidationService $validator)
    {
        // Validate inputs using external service
        if($errors = $validator->isValid($request)) return response()->json($errors);
        
        // Update the specific feedback using FeedbackRepository
        $this->feedbackRepo->update($feedback, $request->all());

        // The response 
        return response()->json("Feedback Updated Successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feedback $feedback)
    {
        // Delete the specific feedback using FeedbackRepository
        $this->feedbackRepo->delete($feedback);

        // The response
        return response()->json("Feedback Deleted Successfully!");
    }
}

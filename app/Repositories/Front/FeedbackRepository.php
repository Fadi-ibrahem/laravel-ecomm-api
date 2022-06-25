<?php

namespace App\Repositories\Front;

use App\Models\Feedback;
use Illuminate\Pipeline\Pipeline;
use App\Filters\Feedback\FeedbackRatingFilter;
use App\Filters\Feedback\FeedbackCommentFilter;
use App\Filters\Feedback\FeedbackCustomerFilter;
use App\Interfaces\Front\FeedbackRepositoryInterface;

class FeedbackRepository implements FeedbackRepositoryInterface
{
    public function index()
    {
        $feedbacks = app(Pipeline::class)
            ->send(Feedback::query())
            ->through([
                FeedbackCommentFilter::class,
                FeedbackCustomerFilter::class,
                FeedbackRatingFilter::class,
            ])
            ->thenReturn()
            ->paginate(12);

        return $feedbacks;
    }

    public function create(Array $data)
    {
        Feedback::create($data);
    }

    public function update(Feedback $feedback, Array $data)
    {
        $feedback->update($data);
    }

    public function delete(Feedback $feedback)
    {
        $feedback->delete();
    }

    public function show(Feedback $feedback)
    {
        return $feedback;
    }

}

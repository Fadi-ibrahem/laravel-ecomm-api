<?php

namespace App\Interfaces\Front;

use App\Models\Feedback;

interface FeedbackRepositoryInterface
{
    public function index();

    public function create(Array $data);

    public function update(Feedback $feedback, Array $data);

    public function delete(Feedback $feedback);

    public function show(Feedback $feedback);
}

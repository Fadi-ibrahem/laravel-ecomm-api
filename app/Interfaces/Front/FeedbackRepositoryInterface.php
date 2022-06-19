<?php

namespace App\Interfaces\Front;

interface FeedbackRepositoryInterface
{
    public function index();

    public function create();

    public function update();

    public function delete();

    public function show();
}

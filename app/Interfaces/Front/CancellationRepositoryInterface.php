<?php

namespace App\Interfaces\Front;

use App\Models\Cancellation;

interface CancellationRepositoryInterface
{
    public function index();

    public function create(Array $data);

    public function update(Cancellation $cancellation, Array $data);

    public function delete(Cancellation $cancellation);

    public function show(Cancellation $cancellation);
}

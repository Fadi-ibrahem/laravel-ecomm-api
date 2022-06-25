<?php

namespace App\Repositories\Front;

use App\Filters\Cancellation\CancellationDateFilter;
use App\Filters\Cancellation\CancellationNotesFilter;
use App\Filters\Cancellation\CancellationRefundAmountFilter;
use Illuminate\Pipeline\Pipeline;
use App\Interfaces\Front\CancellationRepositoryInterface;
use App\Models\Cancellation;

class CancellationRepository implements CancellationRepositoryInterface
{
    public function index()
    {
        $cancellations = app(Pipeline::class)
            ->send(Cancellation::query())
            ->through([
                CancellationDateFilter::class,
                CancellationNotesFilter::class,
                CancellationRefundAmountFilter::class,
            ])
            ->thenReturn()
            ->paginate(12);

        return $cancellations;
    }

    public function create(Array $data)
    {
        Cancellation::create($data);
    }

    public function update(Cancellation $cancellation, Array $data)
    {
        $cancellation->update($data);
    }

    public function delete(Cancellation $cancellation)
    {
        $cancellation->delete();
    }

    public function show(Cancellation $cancellation)
    {
        return $cancellation;
    }
}

<?php

namespace App\Repositories\Front;

use App\Filters\Shipper\ShipperEmailFilter;
use App\Filters\Shipper\ShipperNameFilter;
use App\Filters\Shipper\ShipperRegistrationDateFilter;
use App\Filters\Shipper\ShipperStreetFilter;
use App\Filters\Shipper\ShipperZoneFilter;
use Illuminate\Pipeline\Pipeline;
use App\Interfaces\Front\ShipperRepositoryInterface;
use App\Models\Shipper;

class ShipperRepository implements ShipperRepositoryInterface
{
    public function index()
    {
        $products = app(Pipeline::class)
            ->send(Shipper::query())
            ->through([
                ShipperEmailFilter::class,
                ShipperNameFilter::class,
                ShipperRegistrationDateFilter::class,
                ShipperStreetFilter::class,
                ShipperZoneFilter::class,
            ])
            ->thenReturn()
            ->paginate(12);

        return $products;
    }

    public function create(Array $data)
    {
        Shipper::create($data);
    }

    public function update(Shipper $shipper, Array $data)
    {
        $shipper->update($data);
    }

    public function delete(Shipper $shipper)
    {
        $shipper->delete();
    }

    public function show(Shipper $shipper)
    {
        return $shipper;
    }
}

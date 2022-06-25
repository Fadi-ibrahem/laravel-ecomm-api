<?php

namespace App\Interfaces\Front;

use App\Models\Shipper;

interface ShipperRepositoryInterface
{
    public function index();

    public function create(Array $data);

    public function update(Shipper $shipper, Array $data);

    public function delete(Shipper $shipper);

    public function show(Shipper $shipper);
}

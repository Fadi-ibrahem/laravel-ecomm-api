<?php

namespace App\Interfaces\Front;

use App\Models\Order;

interface OrderRepositoryInterface
{
    public function index();

    public function create(Array $data);

    public function update(Order $order, Array $data);

    public function delete(Order $order);

    public function show(Order $order);
}

<?php

namespace App\Repositories\Front;

use App\Filters\Order\OrderCancellationFilter;
use App\Filters\Order\OrderCardNumberFilter;
use App\Filters\Order\OrderCardTypeFilter;
use App\Filters\Order\OrderCouponFilter;
use App\Filters\Order\OrderCustomerFilter;
use App\Filters\Order\OrderDateFilter;
use App\Filters\Order\OrderDiscountFilter;
use App\Filters\Order\OrderNumberFilter;
use App\Filters\Order\OrderPriceFilter;
use App\Filters\Order\OrderQTYFilter;
use App\Filters\Order\OrderRequiredDateFilter;
use App\Filters\Order\OrderShippedDateFilter;
use App\Filters\Order\OrderShipperFilter;
use App\Filters\Order\OrderStatusFilter;
use App\Filters\Order\OrderTaxFilter;
use App\Filters\Order\OrderTotalPriceFilter;
use Illuminate\Pipeline\Pipeline;
use App\Interfaces\Front\OrderRepositoryInterface;
use App\Models\Order;

class OrderRepository implements OrderRepositoryInterface
{
    public function index()
    {
        $orders = app(Pipeline::class)
            ->send(Order::query())
            ->through([
                OrderCancellationFilter::class,
                OrderCardNumberFilter::class,
                OrderCardTypeFilter::class,
                OrderCouponFilter::class,
                OrderCustomerFilter::class,
                OrderDateFilter::class,
                OrderDiscountFilter::class,
                OrderNumberFilter::class,
                OrderPriceFilter::class,
                OrderQTYFilter::class,
                OrderRequiredDateFilter::class,
                OrderShippedDateFilter::class,
                OrderShipperFilter::class,
                OrderStatusFilter::class,
                OrderTaxFilter::class,
                OrderTotalPriceFilter::class,
            ])
            ->thenReturn()
            ->paginate(12);

        return $orders;
    }

    public function create(Array $data)
    {
        Order::create($data);
    }

    public function update(Order $order, Array $data)
    {
        $order->update($data);
    }

    public function delete(Order $order)
    {
        $order->delete();
    }

    public function show(Order $order)
    {
        return $order;
    }

}

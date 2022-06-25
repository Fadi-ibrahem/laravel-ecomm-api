<?php

namespace App\Repositories\Front;

use App\Models\UserCustomer;
use Illuminate\Pipeline\Pipeline;
use App\Filters\Customer\UserCustomerPhoneFilter;
use App\Filters\Customer\UserCustomerStreetFilter;
use App\Filters\Customer\UserCustomerZoneFilter;
use App\Interfaces\Front\UserCustomerRepositoryInterface;

class UserCustomerRepository implements UserCustomerRepositoryInterface
{
    public function index()
    {
        $customers = app(Pipeline::class)
            ->send(
                UserCustomer::query()
                ->join('users', 'users.id', '=', 'user_customers.user_id')
                )
            ->through([
                UserCustomerPhoneFilter::class,
                UserCustomerStreetFilter::class,
                UserCustomerZoneFilter::class,
            ])
            ->thenReturn()
            ->paginate(12);

        return $customers;
    }

    public function update($id, Array $data)
    {
        UserCustomer::where('user_id', $id)
                    ->update([
                        'phone' => $data['phone'],
                        'zone' => $data['zone'],
                        'street' => $data['street'],
                            ]);
    }

    public function show($id)
    {
        $supplier = UserCustomer::where('user_id', $id)->first();
        return $supplier;
    }

    /*
    public function delete($id)
    {
        $supplier = UserSupplier::where('user_id', $id)->first();
        $supplier->delete();
    }
    */

}

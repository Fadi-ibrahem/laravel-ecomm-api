<?php

namespace App\Repositories\Front;

use App\Filters\Supplier\UserSupplierAddressFilter;
use App\Models\UserSupplier;
use Illuminate\Pipeline\Pipeline;
use App\Interfaces\Front\UserSupplierRepositoryInterface;

class UserSupplierRepository implements UserSupplierRepositoryInterface
{
    public function index()
    {
        $suppliers = app(Pipeline::class)
            ->send(
                UserSupplier::query()
                ->join('users', 'users.id', '=', 'user_suppliers.user_id')
                )
            ->through([
                UserSupplierAddressFilter::class,
            ])
            ->thenReturn()
            ->paginate(12);

        return $suppliers;
    }

    public function update($id, Array $data)
    {
        UserSupplier::where('user_id', $id)
                    ->update(['address' => $data['address']]);
    }

    public function show($id)
    {
        $supplier = UserSupplier::where('user_id', $id)->first();
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

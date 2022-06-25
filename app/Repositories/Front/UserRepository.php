<?php

namespace App\Repositories\Front;

use App\Filters\User\UserEmailFilter;
use App\Filters\User\UserFNameFilter;
use App\Filters\User\UserLNameFilter;
use App\Filters\User\UserTypeFilter;
use App\Models\User;
use Illuminate\Pipeline\Pipeline;
use App\Interfaces\Front\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function index()
    {
        $users = app(Pipeline::class)
            ->send(
                User::query()
                ->leftJoin('user_suppliers', 'users.id', '=', 'user_suppliers.user_id')
                ->leftJoin('user_customers', 'users.id', '=', 'user_customers.user_id')
                )
            ->through([
                UserEmailFilter::class,
                UserFNameFilter::class,
                UserLNameFilter::class,
                UserTypeFilter::class,
            ])
            ->thenReturn()
            ->paginate(12);

        return $users;
    }

    public function update(User $user, Array $data)
    {
        $user->update($data);
    }

    public function delete(User $user)
    {
        $user->delete();
    }

    public function show(User $user)
    {
        return $user;
    }
}

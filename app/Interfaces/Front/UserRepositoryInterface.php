<?php

namespace App\Interfaces\Front;

use App\Models\User;

interface UserRepositoryInterface
{
    public function index();

    public function update(User $user, Array $data);

    public function delete(User $user);

    public function show(User $user);
}

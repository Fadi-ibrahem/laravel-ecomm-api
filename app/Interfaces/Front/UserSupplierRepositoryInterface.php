<?php

namespace App\Interfaces\Front;

use App\Models\UserSupplier;

interface UserSupplierRepositoryInterface
{
    public function index();

    public function update($id, Array $data);

    // public function delete($id);

    public function show($id);
}

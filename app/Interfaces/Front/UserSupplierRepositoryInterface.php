<?php

namespace App\Interfaces\Front;

interface UserSupplierRepositoryInterface
{
    public function update();

    public function delete();

    public function show();
}

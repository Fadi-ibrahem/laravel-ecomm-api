<?php

namespace App\Interfaces\Front;

interface UserCustomerRepositoryInterface
{
    public function update();

    public function delete();

    public function show();
}

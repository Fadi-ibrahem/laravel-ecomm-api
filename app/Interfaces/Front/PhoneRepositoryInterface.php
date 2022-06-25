<?php

namespace App\Interfaces\Front;

use App\Models\Phone;

interface PhoneRepositoryInterface
{
    public function index();

    public function update(Phone $phone, $phoneNumber, $phoneableID);

    public function delete(Phone $phone);

    public function show(Phone $product);

}

<?php

namespace App\Repositories\Front;

use App\Filters\Phone\PhoneNumberFilter;
use App\Filters\Phone\PhonePhonableFilter;
use App\Interfaces\Front\PhoneRepositoryInterface;
use App\Models\Phone;
use Illuminate\Pipeline\Pipeline;

class PhoneRepository implements PhoneRepositoryInterface
{
    public function index()
    {
        $phones = app(Pipeline::class)
            ->send(Phone::query())
            ->through([
                PhoneNumberFilter::class,
                PhonePhonableFilter::class,
            ])
            ->thenReturn()
            ->paginate(12);

        return $phones;
    }

    public function update(Phone $phone, $phoneNumber, $phoneableID)
    {
        (isset($phoneNumber)) ? $phone->phone_number = $phoneNumber : $phone->phone_number = $phone->phone_number;
        (isset($phoneableID)) ? $phone->phoneable_id = $phoneableID : $phone->phoneable_id = $phone->phoneable_id;

        $phone->save();
    }

    public function delete(Phone $phone)
    {
        $phone->delete();
    }

    public function show(Phone $phone)
    {
        return $phone;
    }
}

<?php

namespace App\Services\API\Phone;


class GeneratePhoneModelsService
{
    public static function generatePhoneModels(Array $phonesArr) :Array
    {
        // Generate phone models array to be able to sent as a parameter to saveMany() method
        $phoneModelsArr = [];
        foreach($phonesArr as $phone) {
            $phoneModelsArr[] = new \App\Models\Phone(['phone_number' => $phone]);
        }

        return $phoneModelsArr;
    }
}
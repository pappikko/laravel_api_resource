<?php
namespace App\Services;

use App\Models\Person;

class BmiService
{
    public static function getBmi(Person $person)
    {
        return self::calcBmi($person->height, $person->weight);
    }

    private static function calcBmi(float $height, float $weight)
    {
        if ($height > 0 && $weight > 0) {
            return $weight / $height / $height;
        } else {
            return false;
        }
    }
}

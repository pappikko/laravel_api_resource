<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Models\Person;
use App\Services\BmiService;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BmiServiceTest extends TestCase
{
    /**
     * BMI calc logic test
     *
     * @dataProvider bmiDataProvider
     * @param [type] $height
     * @param [type] $weight
     * @param [type] $result
     * @return void
     */
    public function testCalcBmi($height, $weight, $result)
    {
        $bmiService = new BmiService();
        $method = new \ReflectionMethod(get_class($bmiService), 'calcBmi');
        $method->setAccessible(true);
        $actual = $method->invoke($bmiService, $height, $weight);

        $this->assertEquals($result, $actual, '', 0.2);
    }

    /**
     * BMI get logic test
     *
     * @dataProvider bmiDataProvider
     * @param [type] $height
     * @param [type] $weight
     * @param [type] $result
     * @return void
     */
    public function testGetBmi($height, $weight, $result)
    {
        $person = new Person();
        $person->height = $height;
        $person->weight = $weight;
        $actual = BmiService::getBmi($person);
        $this->assertEquals($result, $actual, '', 0.2);
    }

    public function bmiDataProvider()
    {
        return [
            [1.6,60,23.4735],
            [1.8,80,24.6914],
            [1,0,false],
            [0,50,false],
        ];
    }
}

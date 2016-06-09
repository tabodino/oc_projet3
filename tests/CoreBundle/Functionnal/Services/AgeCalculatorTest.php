<?php
/**
 * Created by PhpStorm.
 * User: jm
 * Date: 08/06/16
 * Time: 20:00
 */

namespace tests\CoreBundle\Functionnal\Services;


use OC\CoreBundle\Services\AgeCalculator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AgeCalculatorTest extends WebTestCase
{
    public function testGetAgeCalculator()
    {
        $birthday1 = '2000-01-01';

        $birthday2 = '2000-09-11';

        $birthday3 = '2000-06-11';

        $ageCalculator = new AgeCalculator();

        $age1 = $ageCalculator->getAge($birthday1);
        $age2 = $ageCalculator->getAge($birthday2);
        $age3 = $ageCalculator->getAge($birthday3);

        $this->assertEquals(16, $age1);
        $this->assertEquals(15, $age2);
        $this->assertEquals(15, $age3);
    }


    public function testGetPriceByAge()
    {
        $ageCalculator = new AgeCalculator();

        $age = $ageCalculator->getPriceByAge(70, true);

        $this->assertEquals(10, $age);

    }
}
<?php
/**
 * Created by PhpStorm.
 * User: jm
 * Date: 06/06/16
 * Time: 13:58
 */

namespace tests\CoreBundle\Unit\Entity;

class PriceTest extends \PHPUnit_Framework_TestCase
{
    protected $price;

    public function __construct()
    {
        parent::__construct();

        $this->price = $this->getMockForAbstractClass('\OC\CoreBundle\Entity\Price');
    }

    public function testIdAttributeEntity()
    {
        $this->price->setId(1);

        $this->assertNotNull($this->price->getId());

        $this->assertEquals(1, $this->price->getId());
    }

    public function testCategoryAttributeEntity()
    {
        $this->price->setCategory("senior");

        $this->assertNotNull($this->price->getCategory());

        $this->assertEquals("senior", $this->price->getCategory());
    }

    public function testPriceAttributeEntity()
    {

        $this->price->setPrice(12.00);

        $this->assertNotNull($this->price->getPrice());

        $this->assertEquals(12.00, $this->price->getPrice());
    }

    public function testAgeMinAttributeEntity()
    {
        $this->price->setAgeMin(12);

        $this->assertNotNull($this->price->getAgeMin());

        $this->assertEquals(12, $this->price->getAgeMin());
    }

    public function testAgeMaxAttributeEntity()
    {
        $this->price->setAgeMax(60);

        $this->assertNotNull($this->price->getAgeMax());

        $this->assertEquals(60, $this->price->getAgeMax());
    }

    public function testRuleAttributeEntity()
    {
        $this->price->setRule("Sous conditions");

        $this->assertNotNull($this->price->getRule());

        $this->assertEquals("Sous conditions", $this->price->getRule());
    }


}
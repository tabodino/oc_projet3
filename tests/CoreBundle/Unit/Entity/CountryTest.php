<?php
/**
 * Created by PhpStorm.
 * User: jm
 * Date: 07/06/16
 * Time: 13:49
 */

namespace tests\CoreBundle\Unit\Entity;


class CountryTest extends \PHPUnit_Framework_TestCase

{
    protected $country;

    public function __construct()
    {
        parent::__construct();

        $this->country = $this->getMockForAbstractClass('\OC\CoreBundle\Entity\Country');
    }

    public function testIdAttributeEntity()
    {
        $this->country->setId(1);

        $this->assertNotNull($this->country->getId());

        $this->assertEquals(1, $this->country->getId());
    }

    public function testCodeAttributeEntity()
    {
        $this->country->setCode(12);

        $this->assertNotNull($this->country->getCode());

        $this->assertEquals(12, $this->country->getCode());
    }

    public function testAlpha2AttributeEntity()
    {
        $this->country->setAlpha2("FR");

        $this->assertNotNull($this->country->getAlpha2());

        $this->assertEquals("FR", $this->country->getAlpha2());
    }

    public function testAlpha3AttributeEntity()
    {
        $this->country->setAlpha3("FRA");

        $this->assertNotNull($this->country->getAlpha3());

        $this->assertEquals("FRA", $this->country->getAlpha3());
    }

    public function testNameEnGbAttributeEntity()
    {
        $this->country->setNameEnGb("FRANCE");

        $this->assertNotNull($this->country->getNameEnGb());

        $this->assertEquals("FRANCE", $this->country->getNameEnGb());
    }

    public function testNameFrFrAttributeEntity()
    {
        $this->country->setNameFrFr("FRANCE");

        $this->assertNotNull($this->country->getNameFrFr());

        $this->assertEquals("FRANCE", $this->country->getNameFrFr());
    }


}
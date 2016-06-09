<?php
/**
 * Created by PhpStorm.
 * User: jm
 * Date: 06/06/16
 * Time: 14:05
 */

namespace tests\CoreBundle\Unit\Entity;


class CustomerTest extends \PHPUnit_Framework_TestCase
{
    protected $customer;

    public function __construct()
    {
        parent::__construct();

        $this->customer = $this->getMockForAbstractClass('\OC\CoreBundle\Entity\Customer');
    }

    public function testIdAttributeEntity()
    {
        $this->customer->setId(1);

        $this->assertNotNull($this->customer->getId());

        $this->assertEquals(1, $this->customer->getId());
    }

    public function testEmailAttributeEntity()
    {
        $this->customer->setEmail("noname@mail.com");

        $this->assertNotNull($this->customer->getEmail());

        $this->assertEquals("noname@mail.com", $this->customer->getEmail());
    }

    public function testCreatedAtAttributeEntity()
    {
        $today = new \DateTime();

        $this->customer->setCreatedAt($today);

        $this->assertNotNull($this->customer->getCreatedAt());

        $this->assertEquals($today, $this->customer->getCreatedAt());
    }



}
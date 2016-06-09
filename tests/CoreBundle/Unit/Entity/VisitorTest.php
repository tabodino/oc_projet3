<?php
/**
 * Created by PhpStorm.
 * User: jm
 * Date: 06/06/16
 * Time: 13:26
 */

namespace tests\CoreBundle\Unit\Entity;


class VisitorTest extends \PHPUnit_Framework_TestCase
{
    protected $visitor;

    public function __construct()
    {
        parent::__construct();

        $this->visitor = $this->getMockForAbstractClass('\OC\CoreBundle\Entity\Visitor');
    }
    
    public function testFirstnameAttributeEntity()
    {

        $this->visitor->setFirstname("John");

        $this->assertNotNull($this->visitor->getFirstname());

        $this->assertEquals("John", $this->visitor->getFirstname());
    }

    public function testLastnameAttributeEntity()
    {

        $this->visitor->setLastname("Doe");

        $this->assertNotNull($this->visitor->getLastname());

        $this->assertEquals("Doe", $this->visitor->getLastname());
    }

    public function testBirthdayAttributeEntity()
    {

        $this->visitor->setBirthday("1990-01-01");

        $this->assertNotNull($this->visitor->getBirthday());

        $this->assertEquals("1990-01-01", $this->visitor->getBirthday());
    }

    public function testCountryAttributeEntity()
    {

        $this->visitor->setCountry("France");

        $this->assertNotNull($this->visitor->getCountry());

        $this->assertEquals("France", $this->visitor->getCountry());
    }

    public function testTicketAttributeEntity()
    {
        // Identifiant ticket
        $this->visitor->setTicket(10);

        $this->assertNotNull($this->visitor->getTicket());

        $this->assertEquals(10, $this->visitor->getTicket());
    }

    public function testPriceAttributeEntity()
    {
        // Identifiant price
        $this->visitor->setPrice(2);

        $this->assertNotNull($this->visitor->getPrice());

        $this->assertEquals(2, $this->visitor->getPrice());
    }

    public function testCustomerAttributeEntity()
    {
        // Identifiant customer
        $this->visitor->setCustomer(52);

        $this->assertNotNull($this->visitor->getCustomer());

        $this->assertEquals(52, $this->visitor->getCustomer());
    }
    
}
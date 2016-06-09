<?php
/**
 * Created by PhpStorm.
 * User: jm
 * Date: 06/06/16
 * Time: 13:45
 */

namespace tests\CoreBundle\Unit\Entity;


class TicketTest extends \PHPUnit_Framework_TestCase
{
    protected $ticket;

    public function __construct()
    {
        parent::__construct();

        $this->ticket = $this->getMockForAbstractClass('\OC\CoreBundle\Entity\Ticket');
    }

    public function testIdAttributeEntity()
    {
        $this->ticket->setId(1);

        $this->assertNotNull($this->ticket->getId());

        $this->assertEquals(1, $this->ticket->getId());
    }

    public function testCodeReservationAttributeEntity()
    {
        $this->ticket->setCodeReservation("fzepo5z165h");

        $this->assertNotNull($this->ticket->getCodeReservation());

        $this->assertEquals("fzepo5z165h", $this->ticket->getCodeReservation());
    }

    public function testDateReservationAttributeEntity()
    {
        $today = new \DateTime();

        $this->ticket->setDateReservation($today->format('Y-m-d'));

        $this->assertNotNull($this->ticket->getDateReservation());

        $this->assertEquals($today->format('Y-m-d'), $this->ticket->getDateReservation());
    }

    public function testFullDayAttributeEntity()
    {
        $this->ticket->setFullDay(true);

        $this->assertNotNull($this->ticket->getFullDay());

        $this->assertEquals(true, $this->ticket->getFullDay());
    }

    public function testReducedAttributeEntity()
    {
        $this->ticket->setReduced(true);

        $this->assertNotNull($this->ticket->isReduced());

        $this->assertEquals(true, $this->ticket->isReduced());
    }


}
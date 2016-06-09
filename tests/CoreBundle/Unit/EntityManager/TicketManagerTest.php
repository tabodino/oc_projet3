<?php
/**
 * Created by PhpStorm.
 * User: jm
 * Date: 08/06/16
 * Time: 18:02
 */

namespace tests\CoreBundle\Unit\EntityManager;


use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TicketManagerTest extends KernelTestCase
{
    private $em;

    protected function setUp()
    {
        self::bootKernel();

        $this->em = static::$kernel
            ->getContainer()
            ->get('oc_core_ticket.manager')
        ;
    }

    public function testGetVisitorByCustomerId()
    {
        $ticket = $this->em->countAllTicketByDay();

        $this->assertGreaterThanOrEqual(1, $ticket);
    }

    public function testEntityManagerGetAll()
    {
        $tickets = $this->em->getAll();

        $this->assertGreaterThanOrEqual(1, $tickets);

    }

    protected function tearDown()
    {
        parent::tearDown();

        $this->em = null;
    }

}
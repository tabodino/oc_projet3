<?php
/**
 * Created by PhpStorm.
 * User: jm
 * Date: 08/06/16
 * Time: 17:51
 */

namespace tests\CoreBundle\Unit\Repository;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TicketRepository extends KernelTestCase
{
    private $em;

    protected function setUp()
    {
        self::bootKernel();

        $this->em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager()
        ;
    }

    public function testGetVisitorByCustomerId()
    {
        $ticket = $this->em
            ->getRepository('OCCoreBundle:Ticket')
            ->countAllTicketByDay()
        ;

        $this->assertGreaterThanOrEqual(1, $ticket);
    }

    protected function tearDown()
    {
        parent::tearDown();

        $this->em->close();
        $this->em = null;
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: jm
 * Date: 08/06/16
 * Time: 18:09
 */

namespace tests\CoreBundle\Unit\EntityManager;


use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class VisitorRepositoryTest extends KernelTestCase
{
    private $em;

    protected function setUp()
    {
        self::bootKernel();

        $this->em = static::$kernel
            ->getContainer()
            ->get('oc_core_visitor.manager')
        ;
    }

    public function testFindVisitorById()
    {
        $visitor = $this->em->find(156) ;

        $this->assertNotNull($visitor);
    }


    public function testGetVisitorByCustomerId()
    {
        $visitor = $this->em->getVisitorByCustomerId(221) ;

        $this->assertGreaterThanOrEqual(1, $visitor);
    }

    public function testGetVisitorByCodeReservation()
    {
        $visitor = $this->em->getVisitorByCodereservation('72c81319e3229a4');

        $this->assertNotNull($visitor);
    }

    protected function tearDown()
    {
        parent::tearDown();

        $this->em = null;
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: jm
 * Date: 08/06/16
 * Time: 17:41
 */

namespace tests\CoreBundle\Unit\Repository;


use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class VisitorRepositoryTest extends KernelTestCase
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
        $visitor = $this->em
            ->getRepository('OCCoreBundle:Visitor')
            ->getVisitorByCustomerId(190)
        ;

        $this->assertGreaterThanOrEqual(1, $visitor);
    }


    protected function tearDown()
    {
        parent::tearDown();

        $this->em->close();
        $this->em = null;
    }

}
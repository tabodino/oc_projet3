<?php
/**
 * Created by PhpStorm.
 * User: jm
 * Date: 08/06/16
 * Time: 18:31
 */

namespace tests\CoreBundle\Unit\Repository;


use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PriceRepositoryTest extends KernelTestCase
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

    public function testGetReducedPrice()
    {
        $price = $this->em
            ->getRepository('OCCoreBundle:Price')
            ->getReducedPrice('reduit')
        ;

        $this->assertNotNull($price);
    }

    protected function tearDown()
    {
        parent::tearDown();

        $this->em->close();
        $this->em = null;
    }

}
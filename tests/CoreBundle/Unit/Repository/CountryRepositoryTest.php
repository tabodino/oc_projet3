<?php
/**
 * Created by PhpStorm.
 * User: jm
 * Date: 08/06/16
 * Time: 17:56
 */

namespace tests\CoreBundle\Unit\Repository;


use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;


class CountryRepositoryTest extends KernelTestCase
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
        $country = $this->em
            ->getRepository('OCCoreBundle:Country')
            ->getCountryBeginWith("Fra")
        ;

        $this->assertGreaterThanOrEqual(1, $country);
    }

    protected function tearDown()
    {
        parent::tearDown();

        $this->em->close();
        $this->em = null;
    }

}
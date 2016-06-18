<?php
/**
 * Created by PhpStorm.
 * User: jm
 * Date: 08/06/16
 * Time: 18:35
 */

namespace tests\CoreBundle\Unit\EntityManager;

use OC\CoreBundle\Controller\CartController;
use OC\CoreBundle\Entity\Customer;
use OC\CoreBundle\EntityManager\CustomerManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CustomerManagerTest extends KernelTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        self::bootKernel();

        $this->em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testUserManager()
    {
        $manager = $this
            ->getMockBuilder('\OC\BackBundle\EntityManager\Customer')
            ->disableOriginalConstructor()
            ->setMethods(array('create'))
            ->getMock()
        ;

        $manager->expects($this->any())
            ->method('create')
            ->will($this->returnValue(true))
        ;

        $cm = new CustomerManager($this->em);

        $customer = new Customer();
        $customer->setEmail('test@mail.com');
        $cm->create($customer);
        

    }
   
}
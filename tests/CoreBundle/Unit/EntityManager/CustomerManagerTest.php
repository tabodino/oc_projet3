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

class CustomerManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateCustomer()
    {
        $customer = new Customer();
        $customer->setId(1);
        $customer->setEmail("email@mail.com");
        $customer->setCreatedAt(new \DateTime());

        $result = new Customer();
        $result->setId(1);
        $result->setEmail("email@mail.com");
        $result->setCreatedAt(new \DateTime());


        $manager = $this
            ->getMockBuilder('\OC\CoreBundle\EntityManager\CustomerManager')
            ->setMethods(array('create'))
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $manager->expects($this->any())
            ->method('create')
            ->with($result)
            //->will($this->returnValue($repository))
        ;

        $manager->create($customer);

    }
}
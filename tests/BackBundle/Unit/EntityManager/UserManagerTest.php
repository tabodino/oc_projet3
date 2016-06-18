<?php
/**
 * Created by PhpStorm.
 * User: jm
 * Date: 10/06/16
 * Time: 13:55
 */

namespace tests\BackBundle\Unit\EntityManager;

use Doctrine\ORM\EntityManager;
use OC\BackBundle\Entity\User;
use OC\BackBundle\EntityManager\UserManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;


class UserManagerTest extends KernelTestCase
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
            ->getMockBuilder('\OC\BackBundle\EntityManager\User')
            ->disableOriginalConstructor()
            ->setMethods(array('deleteUser'))
            ->getMock()
        ;
        
        $manager->expects($this->any())
            ->method('deleteUser')
            ->will($this->returnValue(true))
        ;

        new UserManager($this->em);

    }
}
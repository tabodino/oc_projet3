<?php
/**
 * Created by PhpStorm.
 * User: jm
 * Date: 09/06/16
 * Time: 15:21
 */

namespace tests\BackBundle\Unit\Entity;


class UserTest extends \PHPUnit_Framework_TestCase
{
    protected $user;

    public function __construct()
    {
        parent::__construct();

        $this->user = $this->getMockForAbstractClass('\OC\BackBundle\Entity\User');
    }

    public function testIdAttributeEntity()
    {
        $this->user->setId(1);

        $this->assertNotNull($this->user->getId());

        $this->assertEquals(1, $this->user->getId());
    }


}
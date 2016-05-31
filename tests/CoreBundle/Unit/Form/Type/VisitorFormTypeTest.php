<?php
/**
 * Created by PhpStorm.
 * User: jm
 * Date: 27/05/16
 * Time: 14:04
 */

namespace tests\CoreBundle\Unit\Form\Type;


use Doctrine\Bundle\DoctrineBundle\Tests\DependencyInjection\TestType;
use Doctrine\Tests\Common\Collections\TestObject;
use OC\CoreBundle\Entity\Visitor;
use OC\CoreBundle\Form\Type\VisitorType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Test\TypeTestCase;

class VisitorFormTypeTest extends TypeTestCase
{
    private $entityManager;

    protected function setUp()
    {
        $this->entityManager = $this->getMock('Doctrine\Common\Persistence\ObjectManager');

        parent::setUp();
    }

    public function testLoadVisitorFormType()
    {
        $formData = array('firstname' => 'John');

        $type = new VisitorType();

        $form = $this->factory->create(FormType::class, $type);

        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
    }
    
}
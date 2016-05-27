<?php
/**
 * Created by PhpStorm.
 * User: jm
 * Date: 27/05/16
 * Time: 14:04
 */

namespace tests\CoreBundle\Unit\Form\Type;


use OC\CoreBundle\Form\Type\VisitorType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Test\TypeTestCase;

class VisitorFormTypeTest extends TypeTestCase
{
    public function testLoadVisitorFormType()
    {
        $formData = array('firstname' => 'John');

        $type = new VisitorType();

        $form = $this->factory->create(FormType::class, $type);

        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
    }
}
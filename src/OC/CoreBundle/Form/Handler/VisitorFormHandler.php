<?php
/**
 * Created by PhpStorm.
 * User: Stef et JM
 * Date: 12/05/2016
 * Time: 11:03
 */

namespace OC\CoreBundle\Form\Handler;


use Doctrine\ORM\EntityManager;
use OC\CoreBundle\Entity\Visitor;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

class VisitorFormHandler 
{
    protected $form;
    protected $request;
    protected $em;
    protected $visitor;

    public function __construct(Form $form, Request $request, EntityManager $em, Visitor $visitor)
    {
        $this->form = $form;
        $this->request = $request;
        $this->em = $em;
        $this->visitor = $visitor;
    }

    public function process()
    {
        $this->form->handleRequest($this->request);

        if ($this->request->isMethod('post') && $this->form->isValid()) {
            $this->onSuccess();

            return true;
        }

        return false;

    }

    // Persiste les données si le formulaire est valide
    protected function onSuccess()
    {
        $this->visitor = $this->form->getData();

        $this->em->persist($this->visitor);

        $this->em->flush();

    }

    /**
     * @return Form
     */
    public function getForm()
    {
        return $this->form;
    }
}
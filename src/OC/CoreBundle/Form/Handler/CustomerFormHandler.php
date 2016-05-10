<?php
/**
 * Created by PhpStorm.
 * User: Stef et JM
 * Date: 10/05/2016
 * Time: 11:13
 */

namespace OC\CoreBundle\Form\Handler;


use Doctrine\ORM\EntityManager;
use OC\CoreBundle\Entity\Customer;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

class CustomerFormHandler
{
    protected $form;
    protected $request;
    protected $em;
    protected $customer;

    public function __construct(Form $form, Request $request, EntityManager $em, Customer $customer)
    {
        $this->form = $form;
        $this->request = $request;
        $this->em = $em;
        $this->customer = $customer;
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
        $this->customer = $this->form->getData();

        $this->em->persist($this->customer);

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
<?php
/**
 * Created by PhpStorm.
 * User: jm
 * Date: 25/05/16
 * Time: 19:49
 */

namespace OC\CoreBundle\Form\Handler;


use Doctrine\ORM\EntityManager;
use OC\CoreBundle\Entity\Customer;
use Symfony\Component\HttpFoundation\Request;

class CustomerPayPalFormHandler
{
    protected $request;
    protected $em;
    protected $customer;

    /**
     * CustomerPayPalFormHandler constructor.
     * @param Request $request
     * @param EntityManager $em
     * @param Customer $customer
     */
    public function __construct(Request $request, EntityManager $em, Customer $customer)
    {
        $this->request = $request;
        $this->em = $em;
        $this->customer = $customer;
    }

    /**
     * @param $email
     * @return bool
     */
    public function process($email)
    {
        $this->customer->setEmail($email);

        $this->em->persist($this->customer);

        $this->em->flush();
    }
    
}
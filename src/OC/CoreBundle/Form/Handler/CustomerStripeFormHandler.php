<?php
/**
 * Created by PhpStorm.
 * User: jm
 * Date: 19/05/16
 * Time: 14:31
 */

namespace OC\CoreBundle\Form\Handler;


use Doctrine\ORM\EntityManager;
use OC\CoreBundle\Entity\Customer;
use Symfony\Component\HttpFoundation\Request;

class CustomerStripeFormHandler
{
    protected $request;
    protected $em;
    protected $customer;

    public function __construct(Request $request, EntityManager $em, Customer $customer)
    {
        $this->request = $request;
        $this->em = $em;
        $this->customer = $customer;
    }

    public function process()
    {
        if ($this->request->isMethod('post')) {

            $this->onSuccess();

            return true;
        }

        return false;
    }

    public function onSuccess()
    {
        // Récupération email stripe
        $this->customer->setEmail($this->request->get('stripeEmail'));

        $this->em->persist($this->customer);

        $this->em->flush();
    }


}
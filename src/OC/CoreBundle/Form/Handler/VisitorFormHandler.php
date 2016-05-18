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
use OC\CoreBundle\Services\AgeCalculator;
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

    // Méthode pour récupérer le tarif du visiteur
    public function getAge($birthday)
    {

        $ageCalc = new AgeCalculator();
        $age = $ageCalc->getAge($birthday);
        $price = $this->em->getRepository('OCCoreBundle:Price')->getPriceByAge($age);

        return $price;
    }
    

    // Persiste les données si le formulaire est valide
    protected function onSuccess()
    {
        $this->visitor = $this->form->getData();
        // Vérifie si le tarif est réduit
        if ($this->visitor->getTicket()->isReduced()) {

            $this->visitor->setPrice($this->getreducedPrice());
        }else {
            $birthday = $this->visitor->getBirthday()->format('Y-m-d');

            $this->visitor->setPrice($this->getAge($birthday));
        }

        $this->em->persist($this->visitor);

        $this->em->flush();

    }

    public function getreducedPrice()
    {
        return $this->em->getRepository('OCCoreBundle:Price')->getReducedPrice('reduit');
    }

    /**
     * @return Form
     */
    public function getForm()
    {
        return $this->form;
    }

}
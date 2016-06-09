<?php
/**
 * Created by PhpStorm.
 * User: jm
 * Date: 02/06/16
 * Time: 14:34
 */

namespace OC\CoreBundle\Form\Handler;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityNotFoundException;
use OC\CoreBundle\Entity\Price;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

class PriceFormHandler
{
    protected $request;
    protected $em;


    public function __construct(Request $request, EntityManager $em)
    {

        $this->request = $request;
        $this->em = $em;
    }

    public function process()
    {
        if ($this->request->isMethod('post')) {
            $this->onSuccess();

            return true;
        }

        return false;
    }
    
    
    // Persiste les données si le formulaire est valide
    protected function onSuccess()
    {
        $price = $this->findPriceById($this->request->get('id'));

        $amount = round($this->request->get('price'), 2);

        $price->setPrice($amount);

        $this->em->persist($price);

        $this->em->flush();
    }

    public function findPriceById($id)
    {
        $price = null;

        $price = $this->em->getRepository('OCCoreBundle:Price')->find($id);

        if ( $price != null) {
            return $price;
        }
        throw new EntityNotFoundException("Tarif non trouvé");


    }
    
}
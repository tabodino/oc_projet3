<?php
/**
 * Created by PhpStorm.
 * User: jm
 * Date: 19/05/16
 * Time: 18:06
 */

namespace OC\CoreBundle\EntityManager;

use Doctrine\ORM\EntityManager;

class VisitorManager
{
    protected $em;


    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    // Trouve un visiteur/reservation
    public function find($id)
    {
        $visitor = $this->em->getRepository('OCCoreBundle:Visitor')->findVisitorById($id);
        if (!$visitor) {
            throw $this->createNotFoundException('Visiteur non trouvé');
        }
        return $visitor;
    }

    // Méthode pour trouver les réservations du panier
    public function findArray($array)
    {
        return $this->getRepository()->findArray($array);
    }


    // Enregistre l'id client pour chaque reservation
    public function setVisitorByCustomerId($customerId, $cart)
    {
        foreach ($cart as $key=>$value)

            $this->getRepository()->setCustomerId($customerId, $key);

        return $this->getVisitorByCustomerId($customerId);
    }

    // Liste les visiteurs appartenant à un client
    public function getVisitorByCustomerId($customerId)
    {
        return $this->getRepository()->getVisitorByCustomerId($customerId);
    }

    // Trouve une reservation par son code (QR-Code)
    public function getVisitorByCodeReservation($codeReservation)
    {
        $visitor = $this->getRepository()->getVisitorByCodeReservation($codeReservation);
        
        return $visitor;
    }

    // Supprime un visiteur/reservation
    public function remove($id)
    {
        $this->em->remove($this->find($id));
        $this->flush();
    }

    private function flush()
    {
        $this->em->flush();
    }

    private function getRepository()
    {
        return $this->em->getRepository('OCCoreBundle:Visitor');
    }

}
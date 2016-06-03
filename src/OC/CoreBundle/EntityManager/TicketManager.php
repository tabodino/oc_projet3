<?php
/**
 * Created by PhpStorm.
 * User: jm
 * Date: 03/06/16
 * Time: 16:31
 */

namespace OC\CoreBundle\EntityManager;


use Doctrine\ORM\EntityManager;

class TicketManager
{
    protected $em;

    // Constructeur
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    // Retourne tous les prix
    public function getAll()
    {
        return $this->getRepository('OCCoreBundle:Ticket')->findAll();
    }
    

    // Compte le nombre de tickets par jour
    public function countAllTicketByDay()
    {
        return $this->getRepository()->countAllTicketByDay();
    }

    private function getRepository()
    {
        return $this->em->getRepository('OCCoreBundle:Ticket');
    }
}
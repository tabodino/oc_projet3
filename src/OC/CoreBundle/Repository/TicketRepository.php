<?php

namespace OC\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;
/**
 * TicketRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TicketRepository extends EntityRepository
{
    // Méthode pour trouver les produits du panier
    public function findArray($array)
    {
        $qb = $this->createQueryBuilder('t')
            ->select('t')
            ->where('t.id IN (:array)')
            ->setParameter('array', $array)
        ;
        
        return $qb->getQuery()->getResult();
    }

    
    // Compte le nombre de ticket journalier
    public function countAllTicketByDay()
    {
        $qb = $this->createQueryBuilder('t')
            ->select('COUNT(t.id), t.dateReservation')
            ->where('t.dateReservation <= :now')
            ->setParameter('now', new \DateTime('now'))
            ->groupBy('t.dateReservation')
            ->getQuery()
            ->getResult();

        return $qb;
    }
    
}

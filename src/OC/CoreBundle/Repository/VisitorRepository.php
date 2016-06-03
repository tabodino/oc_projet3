<?php

namespace OC\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * VisitorRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class VisitorRepository extends EntityRepository
{
    // Méthode pour trouver les réservations du panier
    public function findArray($array)
    {
        $qb = $this->createQueryBuilder('v')
            ->select('v')
            ->where('v.id IN (:array)')
            ->setParameter('array', $array)
        ;

        return $qb->getQuery()->getResult();
    }


    // Méthode pour trouver les billets d'un client
    public function getVisitorByCustomerId($customerId)
    {
        $qb = $this->createQueryBuilder('v')
            ->select('v, t', 'p', 'c')
            ->join('v.ticket', 't')
            ->join('v.price', 'p')
            ->join('v.customer', 'c')
            ->where('c.id = v.customer AND v.customer = :customerId')
            ->andWhere('v.ticket = t.id')
            ->andWhere('v.price = p.id')
            ->setParameter('customerId', $customerId)
        ;

        return $qb->getQuery()->getResult();
    }

    // Méthode pur retrouver un visiteur
    public function findVisitorById($id)
    {
        $qb = $this->createQueryBuilder('v')
            ->select('v, t', 'p')
            ->join('v.ticket', 't')
            ->join('v.price', 'p')
            ->where('v.ticket = t.id')
            ->andWhere('v.price = p.id')
            ->andWhere('v.id = :id')
            ->setParameter('id', $id)
        ;

        return $qb->getQuery()->getSingleResult();

    }

    // Méthode pour enregistrer l'identifiant client
    public function setCustomerId($customerId, $id)
    {
        $this->createQueryBuilder('v')
            ->update('OCCoreBundle:Visitor','v')
            ->set('v.customer', '?1')
            ->where('v.id = ?2')
            ->setParameters(array('1' => $customerId, '2' => $id))
            ->getQuery()
            ->execute()
        ;
    }

    // Méthode pour retouver un réservation via son code (QR-code)
    public function getVisitorByCodeReservation($codeReservation)
    {
        $qb = $this->createQueryBuilder('v')
            ->select('v, t, p, c')
            ->join('v.ticket', 't')
            ->join('v.price', 'p')
            ->join('v.customer', 'c')
            ->where('v.ticket = t.id')
            ->andWhere('v.price = p.id')
            ->andWhere('v.customer = c.id')
            ->andWhere('t.codeReservation = :codeReservation')
            ->setParameter('codeReservation', $codeReservation)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }

    // Méthode pour compter le nombre de visiteur par rapport à une date
    public function countVisitorByDateReservation($dateReservation)
    {
        $qb = $this->createQueryBuilder('v')
            ->select('COUNT(v)')
            ->join('v.ticket', 't')
            ->where('v.ticket = t.id')
            ->andWhere('t.dateReservation = :dateReservation')
            ->setParameter('dateReservation', $dateReservation)
        ;

        return $qb->getQuery()->getSingleScalarResult();

    }

    // Compte le nombre de reservations totales
    public function countTotalVisitors()
    {
        return $this->createQueryBuilder('v')
            ->select('COUNT(v)')
            ->join('v.customer', 'c')
            ->where('v.customer = c.id')
            ->getQuery()
            ->getSingleScalarResult();
    }

    // Compte le nombre de reservations mensuelles
    public function countMonthlyVisitors()
    {
        $date = new \DateTime();
        $month = $date->format('Y-m');
        $start = $month."-01";
        $end = $month."-31";
        
        $qb = $this->createQueryBuilder('v')
            ->select('COUNT(v)')
            ->join('v.customer', 'c')
            ->join('v.ticket', 't')
            ->where('v.customer = c.id')
            ->andWhere('v.ticket = t.id')
            ->andWhere('t.dateReservation > :start')
            ->andWhere('t.dateReservation < :end')
            ->setParameters(array('start' => $start, 'end' =>$end))
            ->getQuery()
        ;

        return $qb->getSingleScalarResult();
    }

    // Compte le nombre de reservations hebdomadaires
    public function countWeeklyVisitors()
    {
        $start = new \DateTime('+1 weeks ago');
        $end = new \DateTime();

        $qb = $this->createQueryBuilder('v')
            ->select('COUNT(v)')
            ->join('v.customer', 'c')
            ->join('v.ticket', 't')
            ->where('v.customer = c.id')
            ->andWhere('v.ticket = t.id')
            ->andWhere('t.dateReservation >= :start')
            ->andWhere('t.dateReservation < :end')
            ->setParameters(array('start' => $start, 'end' =>$end))
            ->getQuery()
        ;

        return $qb->getSingleScalarResult();
    }

    // Compte le nombre de reservations journalières
    public function countDailyVisitors()
    {
        $today = new \DateTime();
        $day = $today->format('Y-m-d');

        $qb = $this->createQueryBuilder('v')
            ->select('COUNT(v)')
            ->join('v.customer', 'c')
            ->join('v.ticket', 't')
            ->where('v.customer = c.id')
            ->andWhere('v.ticket = t.id')
            ->andWhere('t.dateReservation = :day')
            ->setParameter('day', $day)
            ->getQuery()
        ;

        return $qb->getSingleScalarResult();

    }

    // Compte le nombre de visiteurs par pays
    public function countVisitorsByCountry()
    {
        return $this->createQueryBuilder('v')
            ->select('COUNT(v.id) AS myCount, v.country')
            ->groupBy('v.country')
            ->addOrderBy('myCount', 'DESC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();
        
    }

    // Retourne le nombre de visteurs par categorie de prix
    public function countCategoryPrice()
    {
        return $this->createQueryBuilder('v')
            ->select('COUNT(v.id) AS myCount, p.category')
            ->join('v.price', 'p')
            ->where('v.price = p.id')
            ->groupBy('p.category')
            ->getQuery()
            ->getResult();
    }





}

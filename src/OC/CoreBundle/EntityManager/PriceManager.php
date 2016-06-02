<?php
/**
 * Created by PhpStorm.
 * User: Stef et JM
 * Date: 11/05/2016
 * Time: 13:20
 */

namespace OC\CoreBundle\EntityManager;

use Doctrine\ORM\EntityManager;

class PriceManager
{
    protected $em;

    // Constructeur
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    // Retourne tous les tarifs
    public function getAll()
    {
        return $this->em
            ->getRepository('OCCoreBundle:Price')
            ->findAll()
        ;
    }

}
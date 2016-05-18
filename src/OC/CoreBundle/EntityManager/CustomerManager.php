<?php
/**
 * Created by PhpStorm.
 * User: Stef et JM
 * Date: 10/05/2016
 * Time: 10:52
 */
namespace OC\CoreBundle\EntityManager;

use Doctrine\ORM\EntityManagerInterface;

class CustomerManager
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function create($customer)
    {
        try {
            $this->em->persist($customer);

            $this->flush();

        }catch (\Doctrine\ORM\ORMException $e) {}

    }

    private function flush()
    {
        $this->em->flush();
    }
}
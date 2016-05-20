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
        return $this->getRepository()->findVisitorById($id);
    }

     // Supprime un visiteur/reservation
     public function remove($id)
     {
         $this->remove($this->find($id));
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
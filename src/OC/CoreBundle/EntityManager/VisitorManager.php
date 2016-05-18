<?php
/**
 * Created by PhpStorm.
 * User: jm
 * Date: 17/05/16
 * Time: 18:24
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

       return $this->em->getRepository('OCCoreBundle:Visitor')->find($id);

        //return $this->getRepository()->find($id);
    }

    // Supprime un visiteur/reservation
   /* public function remove($id)
    {
        $this->remove($this->find($id));

        $this->flush();
    }*/
    
  /*  private function flush()
    {
        $this->em->flush();
    }*/

  /*  private function getRepository()
    {
        return $this->em->getRepository('OCCoreBundle:Visitor');
    }*/
}
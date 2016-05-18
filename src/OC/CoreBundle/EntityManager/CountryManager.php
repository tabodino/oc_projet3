<?php
/**
 * Created by PhpStorm.
 * User: jm
 * Date: 18/05/16
 * Time: 17:49
 */

namespace OC\CoreBundle\EntityManager;


use Doctrine\ORM\EntityManager;

class CountryManager
{
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getAll()
    {
        return $this->getRepository()->findAll();
    }

    public function getCountryBeginWith($word)
    {
        $countries = array();
        $tabCountries = $this->getRepository()->getCountryBeginWith($word);
        foreach ($tabCountries as $c) {
            foreach ($c as $key=>$value) {
                array_push($countries, $value);
            }
        }
        return $countries;
    }

    public function getRepository()
    {
        return $this->em->getRepository('OCCoreBundle:Country');
    }
}
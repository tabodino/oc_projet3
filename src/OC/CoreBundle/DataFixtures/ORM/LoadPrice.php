<?php
/**
 * Created by PhpStorm.
 * User: Stef et JM
 * Date: 10/05/2016
 * Time: 11:43
 */

namespace OC\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use OC\CoreBundle\Entity\Price;

class LoadPrice implements FixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {

        $prices = array();
        // param array(category, price, ageMin, ageMax, condition)
        $prices[0] = array('petit', 0, 0, 4, null);
        $prices[1] = array('enfant', 8, 4, 12, null);
        $prices[2] = array('normal', 16, 12, 60, null);
        $prices[3] = array('réduit', 10, null, null, "Sous condition *");
        $prices[4] = array('senior', 12, 60, null, null);
        $prices[5] = array('famille', 35, null, null, "Même nom de famille requis");

        foreach ($prices as $pr) {
            $price = new Price();
            $price->setCategory($pr[0]);
            $price->setPrice($pr[1]);
            $price->setAgeMin($pr[2]);
            $price->setAgeMax($pr[3]);
            $price->setRule($pr[4]);

            $manager->persist($price);
        }

        $manager->flush();
    }
}
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
        $prices = array(
            'petit' => 0,
            'enfant' => 8,
            'normal' => 16,
            'réduit' => 10,
            'sénior' => 12,
            'famille' => 35,
        );

        foreach ($prices as $key => $value) {

            $price = new Price();
            $price->setCategory($key);
            $price->setPrice($value);

            $manager->persist($price);
        }

        $manager->flush();
    }
}
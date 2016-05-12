<?php
/**
 * Created by PhpStorm.
 * User: Stef et JM
 * Date: 12/05/2016
 * Time: 10:45
 */

namespace OC\CoreBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use OC\CoreBundle\Entity\Visitor;

class LoadVisitor implements FixtureInterface
{
    // Nombre de visiteurs à générer
    const NB_MAX_VISITORS = 10;

    public function load(ObjectManager $manager)
    {
        // Création de faux profils visiteurs
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < self::NB_MAX_VISITORS; $i++)
        {
            $visitor = new Visitor();
            $visitor->setFirstname($faker->firstName);
            $visitor->setLastname($faker->lastName);
            $visitor->setCountry($faker->country);
            //Date de naissance aléatoire
            $visitor->setBirthday(new \DateTime(rand(1940, 2015).'-'.rand(01, 12).'-'.rand(00,31)));


            $manager->persist($visitor);
        }

        $manager->flush();
    }
}
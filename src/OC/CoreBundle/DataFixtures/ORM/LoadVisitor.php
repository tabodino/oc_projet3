<?php
/**
 * Created by PhpStorm.
 * User: Stef et JM
 * Date: 12/05/2016
 * Time: 10:45
 */

namespace OC\CoreBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use OC\CoreBundle\Entity\Visitor;

class LoadVisitor extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
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
            // Simulation relation
            $visitor->setPrice($this->getReference('price'.rand(1,6)));
            $visitor->setTicket($this->getReference('ticket'.$i));
            $visitor->setCustomer($this->getReference('customer'.rand(1, 5)));
            //Date de naissance aléatoire
            $visitor->setBirthday(new \DateTime(rand(1940, 2015).'-'.rand(01, 12).'-'.rand(00,31)));


            $manager->persist($visitor);
        }

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 2;
    }
}
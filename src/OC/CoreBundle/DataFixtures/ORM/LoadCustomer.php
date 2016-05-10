<?php
/**
 * Created by PhpStorm.
 * User: Stef et JM
 * Date: 10/05/2016
 * Time: 10:12
 */
namespace OC\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use OC\CoreBundle\Entity\Customer;

class LoadCustomer implements FixtureInterface
{
    // Nombre de clientà générer
    const NB_MAX_CUSTOMERS = 10;

    public function load(ObjectManager $manager)
    {
        // Création de faux profils
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < self::NB_MAX_CUSTOMERS; $i++)
        {
            $customer = new Customer();
            $customer->setFirstname($faker->firstName);
            $customer->setLastname($faker->lastName);
            $customer->setEmail($faker->email);
            $customer->setCountry($faker->country);
            //Date de naissance aléatoire
            $customer->setBirthday(new \DateTime(rand(1940, 2015).'-'.rand(01, 12).'-'.rand(00,31)));

            $manager->persist($customer);
        }

        $manager->flush();
    }
}
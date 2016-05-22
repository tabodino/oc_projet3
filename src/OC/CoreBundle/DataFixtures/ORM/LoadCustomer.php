<?php
/**
 * Created by PhpStorm.
 * User: jm
 * Date: 22/05/16
 * Time: 18:01
 */

namespace OC\CoreBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use OC\CoreBundle\Entity\Customer;

class LoadCustomer extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{
    // Nombre de clients à générer
    const NB_MAX_CUSTOMERS = 5;

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        // Création de faux profils clients
        $faker = \Faker\Factory::create();

        for ($i = 1; $i <= self::NB_MAX_CUSTOMERS; $i++)
        {
            $customer = new Customer();

            $customer->setEmail($faker->email);

            $manager->persist($customer);
            $this->addReference('customer'.$i, $customer);
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
        return 1;
    }
}
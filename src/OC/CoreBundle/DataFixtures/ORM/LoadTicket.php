<?php
/**
 * Created by PhpStorm.
 * User: jm
 * Date: 22/05/16
 * Time: 18:29
 */

namespace OC\CoreBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use OC\CoreBundle\Entity\Ticket;

class LoadTicket extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{
    // Nombre de tickets à générer
    const NB_MAX_TICKETS = 10;
    
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < self::NB_MAX_TICKETS; $i++)
        {
            $ticket = new Ticket();
            $ticket->setFullDay(rand(0,1));
            $ticket->setReduced(0);
            $ticket->setDateReservation(new \DateTime());

            $manager->persist($ticket);
            $this->addReference('ticket'.$i, $ticket);
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
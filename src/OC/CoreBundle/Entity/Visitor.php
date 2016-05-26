<?php

namespace OC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\RangeValidator;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use OC\CoreBundle\Validator\Constraints\MaxEntryByDay;

/**
 * Visitor
 *
 * @ORM\Table(name="visitor")
 * @ORM\Entity(repositoryClass="OC\CoreBundle\Repository\VisitorRepository")
 */
class Visitor
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=150)
     * @Assert\Length(min=2, minMessage="Le prénom doit contenir au moins {{ limit }} caractères.")
     * @Assert\NotBlank()
     */
    protected $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=150)
     * @Assert\Length(min=2, minMessage="Le nom doit contenir au moins {{ limit }} caractères.")
     * @Assert\NotBlank()
     */
    protected $lastname;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthday", type="date")
     * @Assert\Date()
     * @Assert\Range(
     *     min = "1910-01-01",
     *     max = "now",
     *
     * )
     */
    protected $birthday;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255)
     * @Assert\NotBlank()
     */
    protected $country;

    /**
     * @var string
     *
     * @ORM\OneToOne(targetEntity="OC\CoreBundle\Entity\Ticket", cascade={"persist", "remove"})
     * @MaxEntryByDay()
     */
    protected $ticket;


    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="OC\CoreBundle\Entity\Price")
     */
    protected $price;

    /**
     * @ORM\ManyToOne(targetEntity="OC\CoreBundle\Entity\Customer")
     */
    protected $customer;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return Visitor
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return Visitor
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set birthday
     *
     * @param \DateTime $birthday
     *
     * @return Visitor
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday
     *
     * @return \DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return Visitor
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return string
     */
    public function getTicket()
    {
        return $this->ticket;
    }

    /**
     * @param string $ticket
     */
    public function setTicket($ticket)
    {
        $this->ticket = $ticket;
    }

    /**
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param string $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param mixed $customer
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;
    }

    /**
     * @Assert\Callback
     */
    public function isPastDateReservation(ExecutionContextInterface $context)
    {
        $date = $this->getTicket()->getDateReservation();
        $pastDate = new \DateTime('+1 days ago');

        if ($date <= $pastDate) {
            $context
                ->buildViolation('Date réservation passée')
                ->atPath('fullDay')
                ->addViolation()
            ;
        }
    }

    /**
     * @Assert\Callback
     */
    public function isClosedDateReservation(ExecutionContextInterface $context)
    {
        $date = $this->getTicket()->getDateReservation();

        if ($date->format('w') == "2") {
            $context
                ->buildViolation('Le musée est fermé le mardi.')
                ->atPath('fullDay')
                ->addViolation()
            ;
        }

        if ($date->format('w') == "0") {
            $context
                ->buildViolation('Aucune réservation n\'est possible le dimanche.')
                ->atPath('fullDay')
                ->addViolation()
            ;
        }
    }

    /**
     * @Assert\Callback
     */
    public function isNonWorkingDay(ExecutionContextInterface $context)
    {
        $date = $this->getTicket()->getDateReservation();
        

        if ($date->format('m-d') == "05-01" || $date->format('m-d') == "11-01" || $date->format('m-d') == "12-25") {
            $context
                ->buildViolation('Le musée est fermé les 1er mai, 1er novembre et 25 décembre.')
                ->atPath('fullDay')
                ->addViolation()
            ;
        }
    }

    /**
     * @Assert\Callback
     */
    public function pastFullDayReservation(ExecutionContextInterface $context)
    {
        $today = new \DateTime();
        $day = $today->format('Y-m-d');
        $time = $today->format('H:i:s');

        $date = $this->getTicket()->getDateReservation();
        $date = $date->format('Y-m-d');

        if ($date == $day && $this->getTicket()->getFullDay() == 1 && $time > "14:00:00") {
            $context
                ->buildViolation("Il n'est plus possible de réserver pour la journée entière après 14h00.")
                ->atPath('fullDay')
                ->addViolation()
            ;
        }
    }



}


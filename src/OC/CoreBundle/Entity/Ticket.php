<?php

namespace OC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\RangeValidator;
use Symfony\Component\Validator\Context\ExecutionContextInterface;


/**
 * Ticket
 *
 * @ORM\Table(name="ticket")
 * @ORM\Entity(repositoryClass="OC\CoreBundle\Repository\TicketRepository")
 */
class Ticket
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
     * @ORM\Column(name="code_reservation", type="string", length=100)
     */
    protected $codeReservation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_reservation", type="date")
     * @Assert\Date()
     * @Assert\Range(
     *     min = "1910-01-01",
     *     max = "now",
     *
     * )
     *
     */
    protected $dateReservation;

    /**
     * @var bool
     * @ORM\Column(name="full_day", type="boolean")
     * @Assert\NotBlank()
     */
    protected $fullDay;

    /**
     * @var bool
     *
     * @ORM\Column(name="reduced", type="boolean")
     */
    protected $reduced;



    public function __construct()
    {
        $this->codeReservation = $this->generateCodeReservation(15);
    }

    // Méthode pour générer chaine alphanumérique aléatoire
    private function generateCodeReservation($length)
    {
        return substr(sha1(rand()), 0, $length);
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }



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
     * Set codeReservation
     *
     * @param string $codeReservation
     *
     * @return Ticket
     */
    public function setCodeReservation($codeReservation)
    {
        $this->codeReservation = $codeReservation;

        return $this;
    }

    /**
     * Get codeReservation
     *
     * @return string
     */
    public function getCodeReservation()
    {
        return $this->codeReservation;
    }

    /**
     * Set dateReservation
     *
     * @param \DateTime $dateReservation
     *
     * @return Ticket
     */
    public function setDateReservation($dateReservation)
    {
        $this->dateReservation = $dateReservation;

        return $this;
    }

    /**
     * Get dateReservation
     *
     * @return \DateTime
     */
    public function getDateReservation()
    {
        return $this->dateReservation;
    }

    /**
     * Set fullDay
     *
     * @param boolean $fullDay
     *
     * @return Ticket
     */
    public function setFullDay($fullDay)
    {
        $this->fullDay = $fullDay;

        return $this;
    }

    /**
     * Get fullDay
     *
     * @return bool
     */
    public function getFullDay()
    {
        return $this->fullDay;
    }

    /**
     * @return boolean
     */
    public function isReduced()
    {
        return $this->reduced;
    }


    /**
     * @param mixed $reduced
     */
    public function setReduced($reduced)
    {
        $this->reduced = $reduced;
    }
    

}


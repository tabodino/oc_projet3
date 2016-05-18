<?php

namespace OC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use OC\CoreBundle\Validator\AntiPastDateReservation;
use OC\CoreBundle\Validator\AntiPastDateReservationValidator;


/**
 * Ticket
 *
 * @ORM\Table(name="ticket")
 * @ORM\Entity(repositoryClass="OC\CoreBundle\Repository\TicketRepository")
 * @Assert\Callback(methods={"getDateReservationValid"})
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
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="code_reservation", type="string", length=100)
     */
    private $codeReservation;

    /**
     *
     * @ORM\Column(name="date_reservation", type="date")
     * @AntiPastDateReservation(message="Marche pas!")
     * @Assert\Date()
     */
    private $dateReservation;

    /**
     * @var bool
     * @ORM\Column(name="full_day", type="boolean")
     * @Assert\NotBlank()
     */
    private $fullDay;

    /**
     * @var bool
     *
     * @ORM\Column(name="reduced", type="boolean")
     */
    private $reduced;



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



    /**
     * @Assert\Callback
     */
    public function getDateReservationValid(ExecutionContextInterface $context)
    {
            $today = new \DateTime('now');
            $today->format('Y-m-d');

            $dateReservation = $this->getDateReservation();
            $dateReservation->format('Y-m-d');

            if( $today == $dateReservation OR 1 == 1) {

                $context
                    ->buildViolation('Date invalide égale today')
                    ->atPath('dateReservation')
                    ->addViolation()
                ;
            }



    }


}


<?php
/**
 * Created by PhpStorm.
 * User: jm
 * Date: 16/05/16
 * Time: 21:59
 */

namespace OC\CoreBundle\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class AntiPastDateReservation extends Constraint
{
    public $message1 = "Vous ne pouvez pas réserver à une date antérieure à aujourd'hui.";

    public $message2 = "Il n'est plus possible de réserver pour la journée entière après 14h00.";
}
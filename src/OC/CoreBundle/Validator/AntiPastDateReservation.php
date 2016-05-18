<?php
/**
 * Created by PhpStorm.
 * User: jm
 * Date: 16/05/16
 * Time: 21:59
 */

namespace OC\CoreBundle\Validator;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class AntiPastDateReservation extends Constraint
{
    public $message = "Vous ne pouvez pas réserver à une date antérieure à aujourd'hui.";
}
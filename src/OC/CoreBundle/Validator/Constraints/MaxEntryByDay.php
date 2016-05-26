<?php
/**
 * Created by PhpStorm.
 * User: jm
 * Date: 26/05/16
 * Time: 14:40
 */

namespace OC\CoreBundle\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class MaxEntryByDay extends Constraint
{
    public $message = "La capacité d'accueil pour cette journée est dépassée.";
    
}
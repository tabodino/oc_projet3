<?php
/**
 * Created by PhpStorm.
 * User: jm
 * Date: 16/05/16
 * Time: 22:49
 */

namespace OC\CoreBundle\Validator;

use Symfony\Component\Validator\Constraint;


/**
 * @Annotation
 */
class Antiflood extends Constraint
{
    public $message = "Vous avez déjà posté un message il y a moins de 15 secondes, merci d'attendre un peu.";
}
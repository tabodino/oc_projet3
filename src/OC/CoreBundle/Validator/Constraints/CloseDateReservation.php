<?php
/**
 * Created by PhpStorm.
 * User: jm
 * Date: 08/06/16
 * Time: 16:24
 */

namespace OC\CoreBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class CloseDateReservation extends Constraint
{
    public $message1 = "Le musée ferme ses portes le mardi.";

    public $message2 = "Impossible de réserver le dimanche";

    public $message3 = "Le musée est fermé les 1er mai, 1er novembre et 25 décembre.";
}

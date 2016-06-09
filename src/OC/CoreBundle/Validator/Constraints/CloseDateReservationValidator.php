<?php
/**
 * Created by PhpStorm.
 * User: jm
 * Date: 08/06/16
 * Time: 16:27
 */

namespace OC\CoreBundle\Validator\Constraints;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class CloseDateReservationValidator extends ConstraintValidator
{

    /**
     * Checks if the passed value is valid.
     *
     * @param mixed $value The value that should be validated
     * @param Constraint $constraint The constraint for the validation
     */
    public function validate($value, Constraint $constraint)
    {
        $date = $value->getDateReservation();

        if ($date->format('w') == "2") {
            $this->context
                ->buildViolation($constraint->message1)
                ->addViolation()
            ;
        }

        if ($date->format('w') == "0") {
            $this->context
                ->buildViolation($constraint->message2)
                ->addViolation()
            ;
        }

        if ($date->format('m-d') == "05-01" || $date->format('m-d') == "11-01" || $date->format('m-d') == "12-25") {
            $this->context
                ->buildViolation($constraint->message3)
                ->addViolation()
            ;
        }


    }
}
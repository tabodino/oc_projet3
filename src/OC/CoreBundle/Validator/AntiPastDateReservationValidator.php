<?php
/**
 * Created by PhpStorm.
 * User: jm
 * Date: 16/05/16
 * Time: 22:02
 */

namespace OC\CoreBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class AntiPastDateReservationValidator extends ConstraintValidator
{

    /**
     * Checks if the passed value is valid.
     *
     * @param mixed $value The value that should be validated
     * @param Constraint $constraint The constraint for the validation
     */
    public function validate($value, Constraint $constraint)
    {

        if (1 == 1) {
            $this->context->addViolation($constraint->message);
        }


    }
}
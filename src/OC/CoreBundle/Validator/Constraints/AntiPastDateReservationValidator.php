<?php
/**
 * Created by PhpStorm.
 * User: jm
 * Date: 16/05/16
 * Time: 22:02
 */

namespace OC\CoreBundle\Validator\Constraints;

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

        $date = $value->getDateReservation();
        $pastDate = new \DateTime('+1 days ago');

        if ($date <= $pastDate) {
            $this->context
                ->buildViolation($constraint->message1)
                ->addViolation()
            ;
        }

        $today = new \DateTime();
        $day = $today->format('Y-m-d');
        $time = $today->format('H:i:s');
        
        $date = $date->format('Y-m-d');

        if ($date == $day && $value->getFullDay() == 1 && $time > "14:00:00") {
            $this->context
                ->buildViolation($constraint->message2)
                ->addViolation()
            ;
        }

    }
}
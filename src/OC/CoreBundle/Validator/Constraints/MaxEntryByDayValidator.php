<?php
/**
 * Created by PhpStorm.
 * User: jm
 * Date: 26/05/16
 * Time: 14:42
 */

namespace OC\CoreBundle\Validator\Constraints;


use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class MaxEntryByDayValidator extends ConstraintValidator
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function validate($value, Constraint $constraint)
    {
        $date = $value->getDateReservation()->format('Y-m-d');
        $nbVisitor = $this->em->getRepository('OCCoreBundle:Visitor')->countVisitorByDateReservation($date);

        if ($nbVisitor > 1000) {
            $this->context
                ->buildViolation($constraint->message)
                ->addViolation();
        }

    }
}
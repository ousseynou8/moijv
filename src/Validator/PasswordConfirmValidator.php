<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class PasswordConfirmValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        /* @var $constraint \App\Validator\PasswordConfirm */

        if (null === $value || '' === $value) {
            return;
        }
        if($value->getPassword() !== $value->getPasswordConfirm()){
            // TODO: implement the validation here
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $value)
                ->addViolation();
        }


    }
}

<?php

declare(strict_types = 1);

namespace App\User\Infrastructure\Framework\Validator;

use App\User\ApplicationService\FindUserByEmail;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

final class UniqueUserValidator extends ConstraintValidator
{
    private FindUserByEmail $findUserByEmail;

    public function __construct(FindUserByEmail $findUserByEmail)
    {
        $this->findUserByEmail = $findUserByEmail;
    }

    public function validate($value, Constraint $constraint): void
    {
        if (null === $value || '' === $value) {
            return;
        }

        $user = $this->findUserByEmail->__invoke($value);

        if (null !== $user) {
            $this
                ->context
                ->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $value)
                ->addViolation();
        }
    }
}
<?php

declare(strict_types = 1);

namespace App\User\Infrastructure\Framework\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
final class UniqueUser extends Constraint
{
    public $message = 'Already registered user.';
}
<?php

declare(strict_types=1);

namespace App\User\ApplicationService\Exception;

use Exception;
use Throwable;

final class AlreadyExistingUserException extends Exception
{
    public function __construct(string $email, $code = 0, Throwable $previous = null)
    {
        parent::__construct(
            sprintf('User with email "%s" already exists', $email),
            $code,
            $previous
        );
    }
}
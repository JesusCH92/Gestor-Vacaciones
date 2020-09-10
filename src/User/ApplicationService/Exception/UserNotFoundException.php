<?php

declare(strict_types = 1);

namespace App\User\ApplicationService\Exception;

use Exception;
use Throwable;

final class UserNotFoundException extends Exception
{
    public function __construct(string $userId, $code = 0, Throwable $previous = null)
    {
        parent::__construct(
            sprintf('User with id "%s" were not found', $userId),
            $code,
            $previous
        );
    }
}
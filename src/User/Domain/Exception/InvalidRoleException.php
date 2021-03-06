<?php

declare(strict_types=1);

namespace App\User\Domain\Exception;

use Exception;
use Throwable;

final class InvalidRoleException extends Exception
{
    public function __construct(string $value, $code = 0, Throwable $previous = null)
    {
        parent::__construct(sprintf('Provided role "%s" is invalid', $value), $code, $previous);
    }
}
<?php

declare(strict_types = 1);

namespace App\Feastday\Domain\Exception;

use Exception;
use Throwable;

final class InvalidDateException extends Exception
{
    public function __construct(string $value, $code = 0, Throwable $previous = null)
    {
        parent::__construct(sprintf('Provided date "%s" is invalid', $value), $code, $previous);
    }
}
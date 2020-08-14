<?php

declare(strict_types = 1);

namespace App\Calendar\Domain\Exception;

use Exception;
use Throwable;

final class InvalidWorkDayException extends Exception
{
    public function __construct(string $value, $code = 0, Throwable $previous = null)
    {
        parent::__construct(sprintf('Provided work day "%s" is invalid', $value), $code, $previous);
    }
}
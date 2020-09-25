<?php

declare(strict_types=1);

namespace App\TypeDayOff\Domain\Exception;

use Exception;
use Throwable;

final class NegativeCountDayOffException extends Exception
{
    public function __construct($code = 0, Throwable $previous = null)
    {
        parent::__construct('A type day off count could not be negative!', $code, $previous);
    }
}
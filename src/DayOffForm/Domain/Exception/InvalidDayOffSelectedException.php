<?php

declare(strict_types=1);

namespace App\DayOffForm\Domain\Exception;

use Exception;
use Throwable;

final class InvalidDayOffSelectedException extends Exception
{
    public function __construct($code = 0, Throwable $previous = null)
    {
        parent::__construct(
            "The day selected is not correct. Select the days between init date and end date",
            $code,
            $previous
        );
    }
}
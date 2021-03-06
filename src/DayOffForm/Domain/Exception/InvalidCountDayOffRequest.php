<?php

declare(strict_types=1);

namespace App\DayOffForm\Domain\Exception;

use Exception;
use Throwable;

final class InvalidCountDayOffRequest extends Exception
{
    public function __construct(int $remainingDays, $code = 0, Throwable $previous = null)
    {
        parent::__construct(
            "The number of days selected is greater than the remaining days",
            $code,
            $previous
        );
    }
}
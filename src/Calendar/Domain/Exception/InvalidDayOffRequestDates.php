<?php

declare(strict_types=1);

namespace App\Calendar\Domain\Exception;

use Exception;
use Throwable;

final class InvalidDayOffRequestDates extends Exception
{
    public function __construct(string $initDate, string $endDate, $code = 0, Throwable $previous = null)
    {
        parent::__construct(sprintf('"%s" must be greater than "%s"', $endDate, $initDate), $code, $previous);
    }
}
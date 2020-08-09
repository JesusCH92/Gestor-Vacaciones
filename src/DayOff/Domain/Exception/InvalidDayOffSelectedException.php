<?php


namespace App\DayOff\Domain\Exception;

use Exception;
use Throwable;

final class InvalidDayOffSelectedException extends Exception
{
    public function __construct($initDate, $endDate, $code = 0, Throwable $previous = null)
    {
        parent::__construct(
            "The day selected is not correct. Select the days between init date and end date",
            $code,
            $previous
        );
    }
}
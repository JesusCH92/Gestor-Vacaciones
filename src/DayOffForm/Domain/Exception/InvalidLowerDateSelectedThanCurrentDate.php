<?php

declare(strict_types=1);

namespace App\DayOffForm\Domain\Exception;

use Exception;
use Throwable;

final class InvalidLowerDateSelectedThanCurrentDate extends Exception
{
    public function __construct($code = 0, Throwable $previous = null)
    {
        parent::__construct(
            "The date selected is lower than the current date",
            $code,
            $previous
        );
    }

}
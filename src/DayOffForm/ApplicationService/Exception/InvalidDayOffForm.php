<?php

declare(strict_types=1);

namespace App\DayOffForm\ApplicationService\Exception;

use Exception;
use Throwable;

final class InvalidDayOffForm extends Exception
{
    public function __construct($code = 0, Throwable $previous = null)
    {
        parent::__construct(
            "Do not exists the day off form",
            $code,
            $previous
        );
    }
}
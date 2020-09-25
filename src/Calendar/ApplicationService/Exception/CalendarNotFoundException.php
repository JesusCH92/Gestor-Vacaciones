<?php

declare(strict_types=1);

namespace App\Calendar\ApplicationService\Exception;

use Exception;
use Throwable;

final class CalendarNotFoundException extends Exception
{
    public function __construct($code = 0, Throwable $previous = null)
    {
        parent::__construct(sprintf('Calendar was not found'), $code, $previous);
    }
}
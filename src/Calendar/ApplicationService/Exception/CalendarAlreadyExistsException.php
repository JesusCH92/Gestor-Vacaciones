<?php

declare(strict_types=1);

namespace App\Calendar\ApplicationService\Exception;

use Exception;
use Throwable;

final class CalendarAlreadyExistsException extends Exception
{
    public function __construct(string $workingYear, $code = 0, Throwable $previous = null)
    {
        parent::__construct(sprintf('there is already a calendar for the "%s" working year', $workingYear), $code,
            $previous);
    }
}
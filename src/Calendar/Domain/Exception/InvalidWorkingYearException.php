<?php

declare(strict_types = 1);

namespace App\Calendar\Domain\Exception;

use Exception;
use Throwable;

final class InvalidWorkingYearException extends Exception
{
    public function __construct($code = 0, Throwable $previous = null)
    {
        parent::__construct('The year must be greater than or equal to 2019', $code, $previous);
    }
}
<?php

declare(strict_types=1);

namespace App\Feastday\ApplicationService\Exception;

use Exception;
use Throwable;

final class FeastdayAlreadyExistsException extends Exception
{
    public function __construct(string $feastdayDate, $code = 0, Throwable $previous = null)
    {
        parent::__construct(sprintf('there is already a date like "%s" in calendar', $feastdayDate), $code, $previous);
    }
}
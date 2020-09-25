<?php

declare(strict_types=1);

namespace App\Feastday\ApplicationService\Exception;

use Exception;
use Throwable;

final class FeastdayNotFoundException extends Exception
{
    public function __construct($code = 0, Throwable $previous = null)
    {
        parent::__construct(sprintf('Feastday was not exist in Calendar'), $code, $previous);
    }
}
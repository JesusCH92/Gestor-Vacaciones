<?php


namespace App\SuperviseEmployees\ApplicationService\Exception;

use Exception;
use Throwable;

class InvalidDayOffForm extends Exception
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
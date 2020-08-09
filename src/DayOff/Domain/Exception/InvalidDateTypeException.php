<?php


namespace App\DayOff\Domain\Exception;

use Exception;
use Throwable;

final class InvalidDateTypeException extends Exception
{
    public function __construct($code = 0, Throwable $previous = null)
    {
        parent::__construct(
            'The day selected is not correct. Make sure the days are in Y-m-d format or that the date entered is correct.',
            $code,
            $previous
        );
    }
}
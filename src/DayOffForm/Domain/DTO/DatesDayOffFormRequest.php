<?php

declare(strict_types=1);

namespace App\DayOffForm\Domain\DTO;

final class DatesDayOffFormRequest
{
    private $dayOffForm;

    public function __construct($dayOffForm)
    {
        $this->dayOffForm = $dayOffForm;
    }

    public function dayOffForm()
    {
        return $this->dayOffForm;
    }
}
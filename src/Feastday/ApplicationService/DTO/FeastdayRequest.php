<?php

declare(strict_types = 1);

namespace App\Feastday\ApplicationService\DTO;

final class FeastdayRequest
{
    private string $calendarId;
    private string $feastdayDate;

    public function __construct(string $calendarId, string $feastdayDate)
    {
        $this->calendarId = $calendarId;
        $this->feastdayDate = $feastdayDate;
    }

    public function calendarId(): string
    {
        return $this->calendarId;
    }

    public function feastdayDate(): string
    {
        return $this->feastdayDate;
    }
}
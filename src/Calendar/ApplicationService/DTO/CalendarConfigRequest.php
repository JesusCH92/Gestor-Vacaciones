<?php

declare(strict_types = 1);

namespace App\Calendar\ApplicationService\DTO;

final class CalendarConfigRequest
{
    private string $calendarId;

    public function __construct(string $calendarId)
    {
        $this->calendarId = $calendarId;
    }

    public function calendarId(): string
    {
        return $this->calendarId;
    }
}
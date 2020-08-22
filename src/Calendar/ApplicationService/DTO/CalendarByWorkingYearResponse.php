<?php

declare(strict_types = 1);

namespace App\Calendar\ApplicationService\DTO;

final class CalendarByWorkingYearResponse
{
    private string $calendarId;
    private int $workingYear;

    public function __construct(string $calendarId, int $workingYear)
    {
        $this->calendarId = $calendarId;
        $this->workingYear = $workingYear;
    }

    public function calendarId(): string
    {
        return $this->calendarId;
    }

    public function workingYear(): int
    {
        return $this->workingYear;
    }
}
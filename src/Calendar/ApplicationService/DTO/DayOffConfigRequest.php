<?php

declare(strict_types = 1);

namespace App\Calendar\ApplicationService\DTO;

final class DayOffConfigRequest
{
    private string $initDateDayOffRequest;
    private string $endDateDayOffRequest;
    private string $calendarId;

    public function __construct(string $initDateDayOffRequest, string $endDateDayOffRequest, string $calendarId)
    {
        $this->initDateDayOffRequest = $initDateDayOffRequest;
        $this->endDateDayOffRequest = $endDateDayOffRequest;
        $this->calendarId = $calendarId;
    }

    public function initDateDayOffRequest(): string
    {
        return $this->initDateDayOffRequest;
    }

    public function endDateDayOffRequest(): string
    {
        return $this->endDateDayOffRequest;
    }

    public function calendarId(): string
    {
        return $this->calendarId;
    }
}
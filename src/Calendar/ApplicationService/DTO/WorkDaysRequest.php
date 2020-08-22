<?php

declare(strict_types = 1);

namespace App\Company\ApplicationService\DTO;

final class WorkDaysRequest
{
    private string $calendarId;
    private array $workDays;

    public function __construct(string $calendarId, array $workDays)
    {
        $this->calendarId = $calendarId;
        $this->workDays = $workDays;
    }

    public function calendarId(): string
    {
        return $this->calendarId;
    }

    public function workDays(): array
    {
        return $this->workDays;
    }
}
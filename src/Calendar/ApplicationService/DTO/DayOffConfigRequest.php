<?php

declare(strict_types = 1);

namespace App\Calendar\ApplicationService\DTO;

final class DayOffConfigRequest
{
    private string $initDateDayOffRequest;
    private string $endDateDayOffRequest;
    private string $calendaId;

    public function __construct(string $initDateDayOffRequest, string $endDateDayOffRequest, string $calendaId)
    {
        $this->initDateDayOffRequest = $initDateDayOffRequest;
        $this->endDateDayOffRequest = $endDateDayOffRequest;
        $this->calendaId = $calendaId;
    }

    public function initDateDayOffRequest(): string
    {
        return $this->initDateDayOffRequest;
    }

    public function endDateDayOffRequest(): string
    {
        return $this->endDateDayOffRequest;
    }

    public function calendaId(): string
    {
        return $this->calendaId;
    }
}
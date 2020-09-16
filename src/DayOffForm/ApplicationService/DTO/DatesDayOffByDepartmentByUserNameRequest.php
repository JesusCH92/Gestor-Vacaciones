<?php

declare(strict_types=1);

namespace App\DayOffForm\ApplicationService\DTO;

use App\Entity\Calendar;

final class DatesDayOffByDepartmentByUserNameRequest
{
    private Calendar $calendar;
    private int $departmentId;
    private string $userName;
    private string $filteredDayOffFormType;

    public function __construct(Calendar $calendar, int $departmentId, string $userName, string $filteredDayOffFormType)
    {
        $this->calendar = $calendar;
        $this->departmentId = $departmentId;
        $this->userName = $userName;
        $this->filteredDayOffFormType = $filteredDayOffFormType;
    }

    public function calendar(): Calendar
    {
        return $this->calendar;
    }

    public function departmentId(): int
    {
        return $this->departmentId;
    }

    public function userName(): string
    {
        return $this->userName;
    }

    public function filteredDayOffFormType(): string
    {
        return $this->filteredDayOffFormType;
    }
}
<?php


namespace App\DayOffForm\ApplicationService\DTO;


use App\Entity\Calendar;

class DatesDayOffByDepartmentByUserNameRequest
{
    private Calendar $calendar;
    private int $departmentId;
    private string $userName;

    public function __construct(Calendar $calendar, int $departmentId, string $userName)
    {
        $this->calendar = $calendar;
        $this->departmentId =$departmentId;
        $this->userName = $userName;
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

}
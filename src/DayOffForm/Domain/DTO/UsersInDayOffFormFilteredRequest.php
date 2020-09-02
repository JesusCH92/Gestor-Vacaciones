<?php


namespace App\DayOffForm\Domain\DTO;


use App\Entity\Calendar;

final class UsersInDayOffFormFilteredRequest
{
    private Calendar $calendar;
    private int $departmentId;
    private string $userName;
    private string $filtereDayOffFormType;

    public function __construct(Calendar $calendar, int $departmentId, string $userName, string $filtereDayOffFormType)
    {
        $this->calendar = $calendar;
        $this->departmentId = $departmentId;
        $this->userName = $userName;
        $this->filtereDayOffFormType = $filtereDayOffFormType;
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

    public function filtereDayOffFormType(): string
    {
        return $this->filtereDayOffFormType;
    }

}
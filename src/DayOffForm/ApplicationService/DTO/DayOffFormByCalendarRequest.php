<?php


namespace App\DayOffForm\ApplicationService\DTO;


use App\Entity\Calendar;

final class DayOffFormByCalendarRequest
{
    private Calendar $calendar;

    public function __construct(Calendar $calendar)
    {
        $this->calendar = $calendar;
    }

    public function calendar(): Calendar
    {
        return $this->calendar;
    }
}
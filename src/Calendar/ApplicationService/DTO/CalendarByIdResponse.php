<?php


namespace App\Calendar\ApplicationService\DTO;


use App\Entity\Calendar;

class CalendarByIdResponse
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
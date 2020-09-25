<?php

declare(strict_types=1);

namespace App\Calendar\ApplicationService\DTO;

use App\Entity\Calendar;

final class CalendarByYearResponse
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
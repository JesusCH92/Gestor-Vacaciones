<?php

declare(strict_types=1);

namespace App\Calendar\Domain;

use App\Entity\Calendar;

interface CalendarUpdaterRepository
{
    public function getCalendarByCalendarId(string $calendarId): ?Calendar;

    public function saveCalendar(Calendar $calendarEntity): void;
}
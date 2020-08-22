<?php

declare(strict_types = 1);

namespace App\Calendar\Domain;

use App\Calendar\ApplicationService\DTO\CalendarRequest;
use App\Entity\Calendar;

interface CalendarRepository
{
    public function findCalendarByWorkingYear(CalendarRequest $calendarRequest): ?Calendar;
    public function saveCalendarConfig(Calendar $calendar, array $typeDayOffCollection, array $feastdayCollection): void;
}
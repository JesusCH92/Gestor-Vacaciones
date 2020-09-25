<?php

declare(strict_types=1);

namespace App\Calendar\Domain;

use App\Entity\Calendar;

interface CalendarRepository
{
    public function findCalendarByWorkingYear(int $workingYear): ?Calendar;

    public function saveCalendarConfig(
        Calendar $calendar,
        array $typeDayOffCollection,
        array $feastdayCollection
    ): void;
}
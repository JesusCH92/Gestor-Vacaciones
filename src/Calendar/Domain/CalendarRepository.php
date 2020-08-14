<?php

declare(strict_types = 1);

namespace App\Calendar\Domain;

use App\Calendar\ApplicationService\DTO\CalendarRequest;
use App\Calendar\Domain\ValueObject\WorkingYear;
use App\Entity\Calendar;

interface CalendarRepository
{
    public function findCalendarByWorkingYear(WorkingYear $workingYear): ?Calendar;
    public function saveCalendarConfig(CalendarRequest $calendarRequest): void;
}
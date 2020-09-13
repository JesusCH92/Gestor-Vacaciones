<?php

declare(strict_types = 1);

namespace App\Tests\Calendar\Infrastructure;

use App\Calendar\Domain\CalendarRepository;
use App\Entity\Calendar;

class OrmCalendarRepositorySpy implements CalendarRepository
{
    private $validateWasCalled = false;

    public function findCalendarByWorkingYear(int  $workingYear): ?Calendar
    {
        return null;
    }

    public function saveCalendarConfig(Calendar $calendar, array $typeDayOffCollection, array $feastdayCollection): void
    {
        $this->validateWasCalled = true;
        return;
    }

    public function verify(): bool
    {
        return $this->validateWasCalled;
    }
}


<?php


namespace App\Tests\Calendar\Infrastructure;


use App\Calendar\Domain\CalendarRepository;
use App\Entity\Calendar;

class OrmCalendarRepositoryStub implements CalendarRepository
{

    public function findCalendarByWorkingYear(int $workingYear): ?Calendar
    {
        return null;
    }

    public function saveCalendarConfig(Calendar $calendar, array $typeDayOffCollection, array $feastdayCollection): void
    {
    }
}
<?php


namespace App\Tests\Calendar\Infrastructure;


use App\Calendar\Domain\CalendarRepository;
use App\Calendar\Domain\ValueObject\DayOffConfig;
use App\Calendar\Domain\ValueObject\WorkDays;
use App\Calendar\Domain\ValueObject\WorkingYear;
use App\Entity\Calendar;
use App\Entity\Company;

class OrmCalendarRepositoryInvalidStub implements CalendarRepository
{

    public function findCalendarByWorkingYear(int $workingYear): ?Calendar
    {
        return new Calendar(new DayOffConfig('2020-01-01','2021-01-31'), new WorkDays(['1','2','3']), new Company(), new WorkingYear(2020));
    }

    public function saveCalendarConfig(Calendar $calendar, array $typeDayOffCollection, array $feastdayCollection): void
    {

    }
}
<?php

namespace App\Tests\Calendar\ApplicationService;

use App\Calendar\ApplicationService\CreateCalendarConfig;
use App\Calendar\ApplicationService\DTO\CalendarRequest;
use App\Calendar\ApplicationService\Exception\CalendarAlreadyExistsException;
use App\Calendar\Domain\Exception\InvalidDayOffRequestDates;
use App\Calendar\Domain\Exception\InvalidWorkDayException;
use App\Calendar\Domain\Exception\InvalidWorkingYearException;
use App\Entity\Company;
use App\Feastday\Domain\Exception\InvalidDateException;
use App\Tests\Calendar\Infrastructure\OrmCalendarRepositoryInvalidStub;
use App\Tests\Calendar\Infrastructure\OrmCalendarRepositoryStub;
use PHPUnit\Framework\TestCase;

class CreateCalendarConfigTest extends TestCase
{
    /**
     * @test
     */
    public function throwExceptionIfCalendarWorkingYearAlreadyExists()
    {
        $this->expectException(CalendarAlreadyExistsException::class);

        $calendarRequest = new CalendarRequest('2020', '2020-01-01', '2021-01-31', 20, 10, ['1', '2', '3'], [],
            new Company());

        $ormCalendarRepositoryStub = new OrmCalendarRepositoryInvalidStub();
        $createCalendarConfig = new CreateCalendarConfig($ormCalendarRepositoryStub);
        $createCalendarConfig->__invoke($calendarRequest);
    }

    /**
     * @test
     */
    public function throwExceptionIfYearIsBeforeThanTwentyNineteen()
    {
        $this->expectException(InvalidWorkingYearException::class);

        $calendarRequest = new CalendarRequest('2018', '2020-01-01', '2021-01-31', 20, 10, ['1', '2', '3'], [],
            new Company());

        $ormCalendarRepositoryStub = new OrmCalendarRepositoryStub();
        $createCalendarConfig = new CreateCalendarConfig($ormCalendarRepositoryStub);
        $createCalendarConfig->__invoke($calendarRequest);
    }

    /**
     * @test
     */
    public function throwExceptionIfWorkDayValueIsNotBetweenZeroAndSix()
    {
        $this->expectException(InvalidWorkDayException::class);

        $calendarRequest = new CalendarRequest('2020', '2020-01-01', '2021-01-31', 20, 10, ['8', '9'], [],
            new Company());

        $ormCalendarRepositoryStub = new OrmCalendarRepositoryStub();
        $createCalendarConfig = new CreateCalendarConfig($ormCalendarRepositoryStub);
        $createCalendarConfig->__invoke($calendarRequest);
    }

    /**
     * @test
     */
    public function throwExceptionIfInvalidDayOffRequestDates()
    {
        $this->expectException(InvalidDayOffRequestDates::class);

        $calendarRequest = new CalendarRequest('2020', '2020-01-01', '2019-01-31', 20, 10, ['1', '2', '3'], [],
            new Company());

        $ormCalendarRepositoryStub = new OrmCalendarRepositoryStub();
        $createCalendarConfig = new CreateCalendarConfig($ormCalendarRepositoryStub);
        $createCalendarConfig->__invoke($calendarRequest);
    }

    /**
     * @test
     */
    public function throwExceptionIfDateIsInvalid()
    {
        $this->expectException(InvalidDateException::class);

        $calendarRequest = new CalendarRequest('2020', '2020-02-30', '2021-01-31', 20, 10, ['1', '2', '3'], [],
            new Company());

        $ormCalendarRepositoryStub = new OrmCalendarRepositoryStub();
        $createCalendarConfig = new CreateCalendarConfig($ormCalendarRepositoryStub);
        $createCalendarConfig->__invoke($calendarRequest);
    }
}
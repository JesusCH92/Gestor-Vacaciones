<?php

declare(strict_types = 1);

namespace App\Calendar\ApplicationService;

use App\Calendar\ApplicationService\DTO\CalendarRequest;
use App\Calendar\ApplicationService\Exception\CalendarAlreadyExistsException;
use App\Calendar\Domain\CalendarRepository;
use App\Calendar\Domain\ValueObject\DayOffRequest;
use App\Calendar\Domain\ValueObject\WorkDays;
use App\Calendar\Domain\ValueObject\WorkingYear;
use App\DayOff\Domain\Constants\DayOff;
use App\Entity\Calendar;
use App\Entity\FeastDay;
use App\Entity\TypeDayOff;
use App\Featsday\Domain\ValueObject\FeastdayDate;
use App\TypeDayOff\Domain\ValueObject\CountDayOff;
use DateTimeImmutable;

final class CreateCalendarConfig
{
    private CalendarRepository $calendarRepository;

    public function __construct(CalendarRepository $calendarRepository)
    {
        $this->calendarRepository = $calendarRepository;
    }

    public function __invoke(CalendarRequest $calendarRequest)
    {
        $calendarEntity = $this->calendarRepository->findCalendarByWorkingYear($calendarRequest);

        if (null !== $calendarEntity) {
            throw new CalendarAlreadyExistsException($calendarRequest->workingYear());
        }

        $calendar = $this->mappingCalendarFromCalendarRequest($calendarRequest);
        $typeDayOffCollection = $this->mappingTypeDayOffFromCalendarRequest($calendar, $calendarRequest);
        $feastdayCollection = $this->mappingFeastDayFromCalendarRequest($calendar, $calendarRequest);

        $this->calendarRepository->saveCalendarConfig($calendar, $typeDayOffCollection, $feastdayCollection);
    }

    public function mappingCalendarFromCalendarRequest(CalendarRequest $calendarRequest): Calendar
    {
        $workingYear = new WorkingYear(intval($calendarRequest->workingYear()));
        $workDays = new WorkDays($calendarRequest->workDays());
        $dayOffRequest = new DayOffRequest(
            new DateTimeImmutable($calendarRequest->initDateRequest()),
            new DateTimeImmutable($calendarRequest->endDateRequest()),
        );

        $calendarEntity = new Calendar(
            $dayOffRequest,
            $workDays,
            $calendarRequest->workDays(),
            $calendarRequest->company(),
            $workingYear
        );

        return $calendarEntity;
    }

    public function mappingTypeDayOffFromCalendarRequest(Calendar $calendarEntity,CalendarRequest $calendarRequest): array
    {
        $holidayTypeDayOffEntity = new TypeDayOff(
            DayOff::HOLIDAY,
            new CountDayOff(intval($calendarRequest->holidaysNumber())),
            $calendarEntity
        );

        $personalTypeDayOffEntity = new TypeDayOff(
            DayOff::PERSONAL,
            new CountDayOff(intval($calendarRequest->personalDayNumber())),
            $calendarEntity
        );

        $typeDayOffEntityCollection = [
            $holidayTypeDayOffEntity,
            $personalTypeDayOffEntity
        ];

        return $typeDayOffEntityCollection;
    }

    public function mappingFeastDayFromCalendarRequest(Calendar $calendarEntity,CalendarRequest $calendarRequest): array
    {
        $feastDayCollection = [];

        foreach($calendarRequest->feastdayCollection() as $feastday){

            $feastdayDateEntity = new FeastdayDate($feastday);

            array_push($feastDayCollection, new FeastDay(
                $feastdayDateEntity,
                $calendarEntity
            ));
        }

        return $feastDayCollection;
    }
}
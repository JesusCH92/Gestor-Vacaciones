<?php

declare(strict_types = 1);

namespace App\Calendar\ApplicationService;

use App\Calendar\ApplicationService\DTO\DayOffConfigRequest;
use App\Calendar\ApplicationService\Exception\CalendarNotFoundException;
use App\Calendar\Domain\CalendarUpdaterRepository;
use Ramsey\Uuid\Nonstandard\Uuid;

final class DayOffConfigUpdater
{
    private CalendarUpdaterRepository $calendarUpdaterRepository;

    public function __construct(CalendarUpdaterRepository $calendarUpdaterRepository)
    {
        $this->calendarUpdaterRepository = $calendarUpdaterRepository;
    }

    public function __invoke(DayOffConfigRequest $dayOffConfigRequest): void
    {
        $calendarId = $dayOffConfigRequest->calendarId();
        if (!Uuid::isValid($calendarId)) {
            throw new CalendarNotFoundException();
        }

        $calendarEntity = $this->calendarUpdaterRepository->getCalendarByCalendarId($calendarId);

        if (null === $calendarEntity) {
            throw new CalendarNotFoundException();
        }
        
        $calendarEntity->dayOffConfig()->setDayOffConfig(
            $dayOffConfigRequest->initDateDayOffRequest(),
            $dayOffConfigRequest->endDateDayOffRequest()
        );
        
        $this->calendarUpdaterRepository->saveCalendar($calendarEntity);
    }
}
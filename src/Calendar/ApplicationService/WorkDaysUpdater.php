<?php

declare(strict_types = 1);

namespace App\Calendar\ApplicationService;

use App\Calendar\ApplicationService\Exception\CalendarNotFoundException;
use App\Calendar\Domain\CalendarUpdaterRepository;
use App\Company\ApplicationService\DTO\WorkDaysRequest;
use Ramsey\Uuid\Nonstandard\Uuid;

final class WorkDaysUpdater
{
    private CalendarUpdaterRepository $dayOffConfigRepository;

    public function __construct(CalendarUpdaterRepository $dayOffConfigRepository)
    {
        $this->dayOffConfigRepository = $dayOffConfigRepository;
    }

    public function __invoke(WorkDaysRequest $workDaysRequest)
    {
        $calendarId = $workDaysRequest->calendarId();
        if (!Uuid::isValid($calendarId)) {
            throw new CalendarNotFoundException();
        }

        $calendarEntity = $this->dayOffConfigRepository->getCalendarByCalendarId($calendarId);

        if (null === $calendarEntity) {
            throw new CalendarNotFoundException();
        }
        
        $calendarEntity->workDays()->setWorkDays(
            $workDaysRequest->workDays()
        );
        
        $this->dayOffConfigRepository->saveCalendar($calendarEntity);
    }
}
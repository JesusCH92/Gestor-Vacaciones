<?php

declare(strict_types = 1);

namespace App\Calendar\ApplicationService;

use App\Calendar\ApplicationService\DTO\DayOffConfigRequest;
use App\Calendar\ApplicationService\Exception\CalendarNotFoundException;
use App\Calendar\Domain\DayOffConfigRepository;
use Ramsey\Uuid\Nonstandard\Uuid;

final class DayOffConfigUpdate
{
    private DayOffConfigRepository $dayOffConfigRepository;

    public function __construct(DayOffConfigRepository $dayOffConfigRepository)
    {
        $this->dayOffConfigRepository = $dayOffConfigRepository;
    }

    public function __invoke(DayOffConfigRequest $dayOffConfigRequest)
    {
        $calendarId = $dayOffConfigRequest->calendaId();
        if (!Uuid::isValid($calendarId)) {
            throw new CalendarNotFoundException();
        }

        $calendarEntity = $this->dayOffConfigRepository->getCalendarByCalendarId($calendarId);

        if (null === $calendarEntity) {
            throw new CalendarNotFoundException();
        }
        
        $calendarEntity->dayOffConfig()->updateDayOffConfig(
            $dayOffConfigRequest->initDateDayOffRequest(),
            $dayOffConfigRequest->endDateDayOffRequest()
        );
        
        $this->dayOffConfigRepository->saveCalendar($calendarEntity);
    }
}
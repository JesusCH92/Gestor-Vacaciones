<?php

declare(strict_types = 1);

namespace App\Calendar\ApplicationService;

use App\Calendar\ApplicationService\DTO\CalendarRequest;
use App\Calendar\ApplicationService\Exception\CalendarAlreadyExistsException;
use App\Calendar\Domain\CalendarRepository;
use App\Calendar\Domain\ValueObject\WorkingYear;

final class CreateCalendarConfig
{
    private CalendarRepository $calendarRepository;

    public function __construct(CalendarRepository $calendarRepository)
    {
        $this->calendarRepository = $calendarRepository;
    }

    public function __invoke(CalendarRequest $calendarRequest)
    {
        $workingYear = new WorkingYear(intval($calendarRequest->workingYear()));
        $calendarEntity = $this->calendarRepository->findCalendarByWorkingYear($workingYear);

        if (null !== $calendarEntity) {
            throw new CalendarAlreadyExistsException($calendarRequest->workingYear());
        }

        $this->calendarRepository->saveCalendarConfig($calendarRequest);
    }
}
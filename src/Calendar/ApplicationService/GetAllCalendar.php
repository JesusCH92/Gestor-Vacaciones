<?php

declare(strict_types=1);

namespace App\Calendar\ApplicationService;

use App\Calendar\ApplicationService\DTO\CalendarByWorkingYearResponse;
use App\Calendar\Domain\CalendarByWorkingYearRepository;
use App\Entity\Company;

final class GetAllCalendar
{
    private CalendarByWorkingYearRepository $calendarByWorkingYearRepository;

    public function __construct(CalendarByWorkingYearRepository $calendarByWorkingYearRepository)
    {
        $this->calendarByWorkingYearRepository = $calendarByWorkingYearRepository;
    }

    public function __invoke(Company $company): array
    {
        $calendarCollection = $this->calendarByWorkingYearRepository->getAllCalendarByCompany($company);
        $calendarResponseCollection = $this->mappingCalendarEntitiesCollectionToCalendarByWorkingYearResponse($calendarCollection);

        return $calendarResponseCollection;
    }

    public function mappingCalendarEntitiesCollectionToCalendarByWorkingYearResponse(array $calendarEntitiesCollection
    ): array {
        $calendarResponseCollection = [];
        foreach ($calendarEntitiesCollection as $calendarEntity) {
            $calendarResponse = new CalendarByWorkingYearResponse(
                $calendarEntity->calendarId(),
                $calendarEntity->workingYear()->workingYear()
            );
            array_push($calendarResponseCollection, $calendarResponse);
        }

        return $calendarResponseCollection;
    }
}
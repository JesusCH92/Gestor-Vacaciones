<?php

declare(strict_types = 1);

namespace App\Calendar\ApplicationService;

use App\Calendar\ApplicationService\DTO\CalendarConfigRequest;
use App\Calendar\ApplicationService\Exception\CalendarNotFoundException;
use App\Calendar\Domain\CalendarConfigRepository;
use App\Company\ApplicationService\DTO\CalendarConfigResponse;

final class GetCalendarConfig
{
    private CalendarConfigRepository $calendarConfigRepository;

    public function __construct(CalendarConfigRepository $calendarConfigRepository)
    {
        $this->calendarConfigRepository = $calendarConfigRepository;
    }

    public function __invoke(CalendarConfigRequest $calendarConfigRequest): CalendarConfigResponse
    {
        $calendarEntity = $this->calendarConfigRepository->getCalendarByCalendarId($calendarConfigRequest);

        if (null === $calendarEntity) {
            throw new CalendarNotFoundException();
        }
        
        $initDateRequest = $calendarEntity->dayOffConfig()->initDateDayOffRequest()->format('Y-m-d');
        $endDateRequest = $calendarEntity->dayOffConfig()->endDateDayOffRequest()->format('Y-m-d');
        $workDays = $calendarEntity->workDays()->workDays();

        $feastdayEntitiesCollection = $this->calendarConfigRepository->getFeastdayByCalendarId($calendarConfigRequest);
        $feastdayCollection = $this->formatFeastdayEntities($feastdayEntitiesCollection);

        $typeDayOffEntitiesCollection = $this->calendarConfigRepository->getTypeDayOffByCalendarId($calendarConfigRequest);
        $typeDayOffCollection = $this->formatTypeDayOffEntities($typeDayOffEntitiesCollection);

        $calendarConfigResponse = new CalendarConfigResponse(
            $calendarConfigRequest->calendarId(),
            $initDateRequest,
            $endDateRequest,
            $workDays,
            $typeDayOffCollection,
            $feastdayCollection
        );

        return $calendarConfigResponse;
    }

    public function formatFeastdayEntities(array $feastdayEntities): array
    {
        $feastdayCollection = [];

        foreach($feastdayEntities as $feasday){
            array_push($feastdayCollection, 
                $feasday->feastdayDate()->feastdayDate()->format('Y-m-d')
            );
        }

        return $feastdayCollection;
    }

    public function formatTypeDayOffEntities(array $typeDayOffEntities): array
    {
        $typeDayOffCollection = [];

        foreach($typeDayOffEntities as $typeDayOff){
            $dayOff = $typeDayOff->typeDayOff();
            $countDayOff = $typeDayOff->countDayOff()->countDayOff();

            $typeDayOffCollection[$dayOff] = $countDayOff;
        }
        return $typeDayOffCollection;
    }
}
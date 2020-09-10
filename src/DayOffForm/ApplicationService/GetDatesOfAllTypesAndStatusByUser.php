<?php


namespace App\DayOffForm\ApplicationService;


use App\DayOffForm\ApplicationService\DTO\DateByTypeByStatusResponse;
use App\DayOffForm\ApplicationService\DTO\GetDatesOfAllTypesAndStatusRequest;
use App\DayOffForm\Domain\DayOffRepository;

final class GetDatesOfAllTypesAndStatusByUser
{
    private DayOffRepository $dayOffRepository;

    public function __construct(DayOffRepository $dayOffRepository)
    {
        $this->dayOffRepository = $dayOffRepository;
    }

    public function __invoke(GetDatesOfAllTypesAndStatusRequest $getDatesOfAllTypesAndStatusRequest): array
    {
        $calendar = $getDatesOfAllTypesAndStatusRequest->calendar();
        $userId = $getDatesOfAllTypesAndStatusRequest->userId();

        $datesByUser = $this->dayOffRepository->findByCalendarByUser($calendar, $userId);

        return $this->mappingDateByTypeAndStatus($datesByUser);

    }

    public function mappingDateByTypeAndStatus(array $datesByUser): array
    {
        $datesCollection = [];
        foreach ($datesByUser as $date) {
            $dateByTypeByStatus = new DateByTypeByStatusResponse($date['typeDayOff'],
                $date['statusDayOffForm.statusDayOffForm'], $date['dayOffSelected.dayOffSelected']->format('Y-m-d'));
            array_push($datesCollection,$dateByTypeByStatus);
        }
        return $datesCollection;
    }
}
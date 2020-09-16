<?php

declare(strict_types=1);

namespace App\DayOffForm\ApplicationService;

use App\DayOffForm\ApplicationService\DTO\RemainingDaysOffRequest;
use App\DayOffForm\ApplicationService\DTO\RemainingDaysOffResponse;
use App\DayOffForm\Domain\DayOffRepository;
use App\TypeDayOff\Domain\Constants\DayOff;
use App\TypeDayOff\Domain\TypeDayOffRepository;

final class GetRemainingDaysOffByUser
{
    private DayOffRepository $dayOffRepository;
    private TypeDayOffRepository $typeDayOffRepository;

    public function __construct(DayOffRepository $dayOffRepository, TypeDayOffRepository $typeDayOffRepository)
    {
        $this->dayOffRepository = $dayOffRepository;
        $this->typeDayOffRepository = $typeDayOffRepository;
    }

    public function __invoke(RemainingDaysOffRequest $dayOffOfCalendarRequest): RemainingDaysOffResponse
    {
        $dayOffFormCollectionOfHollidays = $this->dayOffRepository->findByUserAndStatusDayOffForm($dayOffOfCalendarRequest->user(),
            $dayOffOfCalendarRequest->calendar(),
            DayOff::HOLIDAY);

        $remainingHolidays = $this->calculateRemainingDaysByType($dayOffFormCollectionOfHollidays,
            $dayOffOfCalendarRequest->typeDayOffCollection()[DayOff::HOLIDAY]);

        $dayOffFormCollectionOfPersonal = $this->dayOffRepository->findByUserAndStatusDayOffForm($dayOffOfCalendarRequest->user(),
            $dayOffOfCalendarRequest->calendar(),
            DayOff::PERSONAL);

        $remainingPersonal = $this->calculateRemainingDaysByType($dayOffFormCollectionOfPersonal,
            $dayOffOfCalendarRequest->typeDayOffCollection()[DayOff::PERSONAL]);

        $arrayRemaingDays = [DayOff::HOLIDAY => $remainingHolidays, DayOff::PERSONAL => $remainingPersonal];

        return new RemainingDaysOffResponse($arrayRemaingDays);

    }

    public function calculateRemainingDaysByType(array $dayOffFormCollection, int $totalCount)
    {
        $count = 0;
        if (!empty($dayOffFormCollection)) {
            foreach ($dayOffFormCollection as $dayOffForm) {
                $count += $dayOffForm['countDayOffRequest.countDayOffRequest'];
            }
            return $totalCount - $count;
        }
        return $totalCount;
    }
}
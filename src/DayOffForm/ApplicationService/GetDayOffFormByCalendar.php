<?php


namespace App\DayOffForm\ApplicationService;


use App\DayOffForm\ApplicationService\DTO\DayOffFormByCalendarRequest;
use App\DayOffForm\Domain\DayOffRepository;

final class GetDayOffFormByCalendar
{
    private DayOffRepository $dayOffRepository;

    public function __construct(DayOffRepository $dayOffRepository)
    {
        $this->dayOffRepository = $dayOffRepository;
    }

    public function __invoke(DayOffFormByCalendarRequest $dayOffFormByCalendarRequest)
    {
        $daysOffForm =$this->dayOffRepository->findByCalendar($dayOffFormByCalendarRequest->calendar());
    }
}
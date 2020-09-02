<?php


namespace App\Calendar\ApplicationService;


use App\Calendar\ApplicationService\DTO\CalendarByYearResponse;
use App\Calendar\Domain\CalendarRepository;

final class CalendarByActualYear
{
    private CalendarRepository $calendarRepository;

    public function __construct(CalendarRepository $calendarRepository)
    {
        $this->calendarRepository = $calendarRepository;
    }

    public function __invoke(int $year): CalendarByYearResponse
    {
        $calendarByWorkingYear = $this->calendarRepository->findCalendarByWorkingYear($year);
        if ($calendarByWorkingYear === null){
            $calendarByWorkingYear = $this->calendarRepository->findCalendarByWorkingYear($year-1);
        }
        return new CalendarByYearResponse($calendarByWorkingYear);
    }
}
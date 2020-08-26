<?php


namespace App\Calendar\ApplicationService;


use App\Calendar\ApplicationService\DTO\CalendarConfigRequest;
use App\Calendar\ApplicationService\DTO\CalendarRequest;
use App\Calendar\ApplicationService\Exception\CalendarNotFoundException;
use App\Calendar\Domain\CalendarConfigRepository;
use App\Calendar\Domain\CalendarRepository;

final class GetCalendarByYear
{
    private CalendarRepository $calendarRepository;
    private GetCalendarConfig $getCalendarConfig;

    public function __construct(CalendarRepository $calendarRepository, GetCalendarConfig $getCalendarConfig)
    {
        $this->calendarRepository = $calendarRepository;
        $this->getCalendarConfig = $getCalendarConfig;
    }

    public function __invoke(int $year)
    {
        $calendar = $this->calendarRepository->findCalendarByYear($year);
        if ($calendar == null){
            throw new CalendarNotFoundException();
        }
        $calendarConfigRequest = new CalendarConfigRequest($calendar->calendarId());
        $getCalendarConfig = $this->getCalendarConfig;
        return $getCalendarConfig->__invoke($calendarConfigRequest);

    }

}
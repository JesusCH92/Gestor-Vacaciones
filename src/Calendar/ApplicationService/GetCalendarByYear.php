<?php


namespace App\Calendar\ApplicationService;

use App\Calendar\ApplicationService\Exception\CalendarNotFoundException;
use App\Calendar\Domain\CalendarRepository;

final class GetCalendarByYear
{
    private CalendarRepository $calendarRepository;

    public function __construct(CalendarRepository $calendarRepository)
    {
        $this->calendarRepository = $calendarRepository;
    }

    public function __invoke(int $year)
    {
        $calendarCollection=[];
        $calendarCollection = $this->actualYear($year,$calendarCollection);
        $calendarCollection = $this->yearBefore($year - 1,$calendarCollection);

        return $calendarCollection;

    }

    public function actualYear(int $actualYear, array $calendarCollection)
    {
        $calendar = $this->calendarRepository->findCalendarByWorkingYear($actualYear);
        if ($calendar == null) {
            throw new CalendarNotFoundException();
        }
        $calendarArray = ['workingYear'=>$calendar->workingYear()->workingYear(),
            'calendarId'=>$calendar->calendarId()];
        array_push($calendarCollection,$calendarArray);
        return $calendarCollection;
    }

    public function yearBefore(int $yearBefore, array $calendarCollection)
    {
        $calendar = $this->calendarRepository->findCalendarByWorkingYear($yearBefore);
        if (null !== $calendar){
            $calendarArray = ['workingYear'=>$calendar->workingYear()->workingYear(),
                'calendarId'=>$calendar->calendarId()];
            array_push($calendarCollection,$calendarArray);
        }
         return $calendarCollection;
    }

}
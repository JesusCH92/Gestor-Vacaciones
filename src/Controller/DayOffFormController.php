<?php


namespace App\Controller;

use App\Calendar\ApplicationService\GetCalendarByYear;
use App\DayOffForm\ApplicationService\GetDatesOfCalendar;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class DayOffFormController extends AbstractController
{
    private GetCalendarByYear $getCalendarByYear;
    private GetDatesOfCalendar $getDatesOfCalendar;

    public function __construct(GetCalendarByYear $getCalendarByYear, GetDatesOfCalendar $getDatesOfCalendar)
    {
        $this->getCalendarByYear = $getCalendarByYear;
        $this->getDatesOfCalendar = $getDatesOfCalendar;
    }

    /**
     * @Route("/dayoff", name="app_dayoff")
     */
    public function index()
    {

        $calendarByYear = $this->getCalendarByYear;
        $year = date("Y");
        $calendarConfigResponse = $calendarByYear->__invoke($year);

        $getDatesOfCalendar = $this->getDatesOfCalendar;

        // $feastday = [];
        // foreach($calendarConfigResponse->feastdayCollection() as $feastdayDate) {
        //     array_push($feastday, $feastdayDate['date']);
        // }
        $calendarInfo = $getDatesOfCalendar->__invoke(
            new DateTimeImmutable( $calendarConfigResponse->initDate() ),
            new DateTimeImmutable(  $calendarConfigResponse->endDate() ),
            $calendarConfigResponse->feastdayCollection()
        );

        return $this->render('dayoff_form/dayoff_form_request/dayoff.html.twig', [
            'year' => $year,
            'calendar' => $calendarConfigResponse,
            'calendar_info' => $calendarInfo,
            'working_days'  =>$calendarConfigResponse->workDays()
        ]);

    }


}
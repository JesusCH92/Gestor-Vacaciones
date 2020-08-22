<?php

namespace App\Controller;

use App\Calendar\ApplicationService\DTO\CalendarConfigRequest;
use App\Calendar\ApplicationService\GetCalendarConfig;
use App\DayOff\ApplicationService\GetDatesOfCalendar;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    private GetDatesOfCalendar $getDatesOfCalendar;
    private GetCalendarConfig $getCalendarConfig;

    public function __construct(GetDatesOfCalendar $getDatesOfCalendar, GetCalendarConfig $getCalendarConfig)
    {
        $this->getDatesOfCalendar = $getDatesOfCalendar;
        $this->getCalendarConfig = $getCalendarConfig;
    }
    
    /**
     * @Route("/dashboard", name="app_dashboard")
     */
    public function index()
    {
        $calendarId = "103f4127-598b-42a1-b672-75999ef7a763";
        $calendar = new CalendarConfigRequest($calendarId);

        $getCalendarConfig =$this->getCalendarConfig;
        $calendarConfigResponse = $getCalendarConfig->__invoke($calendar);

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

        return $this->render('dashboard/dashboard.html.twig', [
            'calendar_info' => $calendarInfo,
            'working_days'  =>$calendarConfigResponse->workDays()
        ]);
    }
}

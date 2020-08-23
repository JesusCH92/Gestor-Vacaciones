<?php

namespace App\Controller;

use App\Calendar\ApplicationService\DTO\CalendarConfigRequest;
use App\Calendar\ApplicationService\GetCalendarById;
use App\Calendar\ApplicationService\GetCalendarConfig;
use App\DayOff\ApplicationService\DTO\DayOffRequest;
use App\DayOff\ApplicationService\SaveDayOffRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class DayOffRequestController extends AbstractController
{
    private SaveDayOffRequest $saveDayOffRequest;
    private GetCalendarConfig $getCalendarConfig;
    private GetCalendarById $getCalendarById;

    public function __construct(SaveDayOffRequest $saveDayOffRequest, GetCalendarById $getCalendarById,GetCalendarConfig $getCalendarConfig)
    {
        $this->saveDayOffRequest = $saveDayOffRequest;
        $this->getCalendarById = $getCalendarById;
        $this->getCalendarConfig = $getCalendarConfig;
    }

    /**
     * @Route("/dayoff/add", options={"expose"=true}, name="app_day_off")
     */
    public function dayOff(Request $request)
    {
        $user = $this->getUser();

        $request = $request->get('day_off_request');

        $calendarId = "5e33d004-4145-40ab-8d08-7bee1854e03a";
        $calendarRequest = new CalendarConfigRequest($calendarId);

        $getCalendarById = $this->getCalendarById;
        $calendar = $getCalendarById->__invoke($calendarRequest);

        $getCalendarConfig =$this->getCalendarConfig;
        $calendarConfigResponse = $getCalendarConfig->__invoke($calendarRequest);

        $saveDayOffRequest = $this->saveDayOffRequest;
        $saveDayOffRequest(
            new DayOffRequest(
                $user,
                $calendar->calendar(),
                $request['type_of_day'],
                json_decode($request['days_off']),
                $calendarConfigResponse->typeDayOffCollection(),
                $calendarConfigResponse->feastdayCollection()
            )
        );

        return Response::create('??');
    }
}
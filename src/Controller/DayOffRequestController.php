<?php

namespace App\Controller;

use App\Calendar\ApplicationService\DTO\CalendarConfigRequest;
use App\Calendar\ApplicationService\GetCalendarById;
use App\Calendar\ApplicationService\GetCalendarConfig;
use App\DayOffForm\ApplicationService\DTO\RemainingDaysOffRequest;
use App\DayOffForm\ApplicationService\DTO\DayOffRequest;
use App\DayOffForm\ApplicationService\GetRemainingDaysOffByUser;
use App\DayOffForm\ApplicationService\SaveDayOffRequest;
use App\Entity\Calendar;
use App\User\Domain\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class DayOffRequestController extends AbstractController
{
    private SaveDayOffRequest $saveDayOffRequest;
    private GetCalendarConfig $getCalendarConfig;
    private GetCalendarById $getCalendarById;
    private GetRemainingDaysOffByUser $getRemainingDaysOffByUser;

    public function __construct(
        SaveDayOffRequest $saveDayOffRequest,
        GetCalendarById $getCalendarById,
        GetCalendarConfig $getCalendarConfig,
        GetRemainingDaysOffByUser $getRemainingDaysOffByUser
    ) {
        $this->saveDayOffRequest = $saveDayOffRequest;
        $this->getCalendarById = $getCalendarById;
        $this->getCalendarConfig = $getCalendarConfig;
        $this->getRemainingDaysOffByUser = $getRemainingDaysOffByUser;
    }

    /**
     * @Route("/dayoff/management/add", options={"expose"=true}, name="app_dayoff_request")
     */
    public function dayOff(Request $request)
    {
        $user = $this->getUser();

        $request = $request->get('day_off_request');

        $calendarId = $request['id_calendar'];
        $calendarRequest = new CalendarConfigRequest($calendarId);

        $getCalendarById = $this->getCalendarById;
        $calendar = $getCalendarById->__invoke($calendarRequest);

        $getCalendarConfig = $this->getCalendarConfig;
        $calendarConfigResponse = $getCalendarConfig->__invoke($calendarRequest);

        $remainingDaysByType = $this->remainingDays($calendar->calendar(), $user, $calendarConfigResponse->typeDayOffCollection(),$request['type_of_day']);

        $saveDayOffRequest = $this->saveDayOffRequest;
        $saveDayOffRequest(
            new DayOffRequest(
                $user,
                $calendar->calendar(),
                $request['type_of_day'],
                json_decode($request['days_off']),
                $calendarConfigResponse->typeDayOffCollection(),
                $calendarConfigResponse->feastdayCollection(),
                $remainingDaysByType
            )
        );

        return Response::create('??');
    }

    private function remainingDays(Calendar $calendar, User $user, array $typeDayOffCollection, string $typeDayOff) :int
    {
        $dayOffOfCalendarRequest = new RemainingDaysOffRequest($calendar, $user,
            $typeDayOffCollection);
        $getRemainingDaysOffByUser = $this->getRemainingDaysOffByUser;
        $remainingDaysOffResponse = $getRemainingDaysOffByUser->__invoke($dayOffOfCalendarRequest);
        return $remainingDaysOffResponse->remainingDaysOff()[$typeDayOff];
    }
}
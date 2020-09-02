<?php


namespace App\Controller;


use App\Calendar\ApplicationService\CalendarByActualYear;
use App\Calendar\ApplicationService\DTO\CalendarConfigRequest;
use App\Calendar\ApplicationService\GetCalendarConfig;
use App\DayOffForm\ApplicationService\DTO\UserInDayOffFormByUserIdRequest;
use App\DayOffForm\ApplicationService\FindDatesDayOffFormByUser;
use App\DayOffForm\ApplicationService\GetDatesOfCalendar;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class FilterDayOffFormByUserId extends AbstractController
{
    private CalendarByActualYear $getCalendarByYear;
    private GetCalendarConfig $getCalendarConfig;
    private GetDatesOfCalendar $getDatesOfCalendar;
    private FindDatesDayOffFormByUser $findDatesDayOffFormByUser;

    public function __construct(
        CalendarByActualYear $getCalendarByYear,
        GetCalendarConfig $getCalendarConfig,
        GetDatesOfCalendar $getDatesOfCalendar,
        FindDatesDayOffFormByUser $findDatesDayOffFormByUser
    ) {
        $this->getCalendarByYear = $getCalendarByYear;
        $this->getCalendarConfig = $getCalendarConfig;
        $this->getDatesOfCalendar = $getDatesOfCalendar;
        $this->findDatesDayOffFormByUser = $findDatesDayOffFormByUser;
    }

    /**
     * @Route("/supervise/dayoff/user/{id}", name="app_supervise_dayoff_user")
     */
    public function findUserInDayOffForm($id)
    {
        $userId = $id;

        $calendarByYear = $this->getCalendarByYear;
        $year = date("Y");
        $calendar = $calendarByYear->__invoke($year);

        $findDatesDayOffFormByUser = $this->findDatesDayOffFormByUser;

        $datesDayOffFormResponse = $findDatesDayOffFormByUser->__invoke(new UserInDayOffFormByUserIdRequest(
            $calendar->calendar(),
            $userId));

        $getCalendarConfig = $this->getCalendarConfig;
        $calendarConfigResponse = $getCalendarConfig->__invoke(new CalendarConfigRequest($calendar->calendar()->calendarId()));

        $getDatesOfCalendar = $this->getDatesOfCalendar;
        $calendarInfo = $getDatesOfCalendar->__invoke(
            new DateTimeImmutable($calendarConfigResponse->initDate()),
            new DateTimeImmutable($calendarConfigResponse->endDate()),
            $calendarConfigResponse->feastdayCollection()
        );

        $dayOffConfigTemplate = $this->render('supervise_employees/supervise_search_day_off/calendar/calendar.html.twig',
            [
                'calendar_info' => $calendarInfo,
                'working_days' => $calendarConfigResponse->workDays(),
                'dates_dayoff' => $datesDayOffFormResponse
            ])->getContent();

        return new JsonResponse([
            'user_dayoff_calendar' => $dayOffConfigTemplate
        ]);


    }
}
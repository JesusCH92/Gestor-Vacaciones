<?php

declare(strict_types=1);

namespace App\DayOffForm\Infrastructure\Controller\DayOffForm;

use App\Calendar\ApplicationService\CalendarByActualYear;
use App\Calendar\ApplicationService\DTO\CalendarConfigRequest;
use App\Calendar\ApplicationService\GetCalendarConfig;
use App\DayOffForm\ApplicationService\DTO\GetDatesOfAllTypesAndStatusRequest;
use App\DayOffForm\ApplicationService\DTO\LastDayOffFormRequestByUserRequest;
use App\DayOffForm\ApplicationService\DTO\RemainingDaysOffRequest;
use App\DayOffForm\ApplicationService\GetDatesOfAllTypesAndStatusByUser;
use App\DayOffForm\ApplicationService\GetDatesOfCalendar;
use App\DayOffForm\ApplicationService\GetLastDayOffFormRequestByUser;
use App\DayOffForm\ApplicationService\GetRemainingDaysOffByUser;
use App\DayOffForm\ApplicationService\GetUsersOnDayOffToday;
use App\Entity\Calendar;
use App\User\Domain\User;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class DashboardController extends AbstractController
{
    private CalendarByActualYear $getCalendarByYear;
    private GetDatesOfCalendar $getDatesOfCalendar;
    private GetCalendarConfig $getCalendarConfig;
    private GetDatesOfAllTypesAndStatusByUser $getDatesOfAllTypesAndStatusByUser;
    private GetUsersOnDayOffToday $getUsersOnDayOffToday;
    private GetRemainingDaysOffByUser $getRemainingDaysOffByUser;
    private GetLastDayOffFormRequestByUser $getLastDayOffFormRequestByUser;

    public function __construct(
        CalendarByActualYear $getCalendarByYear,
        GetDatesOfCalendar $getDatesOfCalendar,
        GetCalendarConfig $getCalendarConfig,
        GetDatesOfAllTypesAndStatusByUser $getDatesOfAllTypesAndStatusByUser,
        GetUsersOnDayOffToday $getUsersOnDayOffToday,
        GetRemainingDaysOffByUser $getRemainingDaysOffByUser,
        GetLastDayOffFormRequestByUser $getLastDayOffFormRequestByUser
    ) {
        $this->getCalendarByYear = $getCalendarByYear;
        $this->getDatesOfCalendar = $getDatesOfCalendar;
        $this->getCalendarConfig = $getCalendarConfig;
        $this->getDatesOfAllTypesAndStatusByUser = $getDatesOfAllTypesAndStatusByUser;
        $this->getUsersOnDayOffToday = $getUsersOnDayOffToday;
        $this->getRemainingDaysOffByUser = $getRemainingDaysOffByUser;
        $this->getLastDayOffFormRequestByUser = $getLastDayOffFormRequestByUser;
    }

    /**
     * @Route("/dashboard", methods={"GET"}, name="app_dashboard")
     */
    public function index()
    {
        $user = $this->getUser();

        $calendarByYear = $this->getCalendarByYear;
        $currentYear = date("Y");
        $calendar = $calendarByYear->__invoke(intval($currentYear));

        $calendarConfigRequest = new CalendarConfigRequest($calendar->calendar()->calendarId());
        $getCalendarConfig = $this->getCalendarConfig;
        $calendarConfigResponse = $getCalendarConfig->__invoke($calendarConfigRequest);

        $getDatesByUserRequest = new GetDatesOfAllTypesAndStatusRequest($calendar->calendar(), $user->userId());
        $getDatesOfAllTypesAndStatusByUser = $this->getDatesOfAllTypesAndStatusByUser;
        $datesByTypeAndStatusCollection = $getDatesOfAllTypesAndStatusByUser->__invoke($getDatesByUserRequest);

        $getUsersOnDayOffToday = $this->getUsersOnDayOffToday;
        $usersOnDayOffTodayCollection = $getUsersOnDayOffToday->__invoke();

        $remainingDaysTypes = $this->remainingDays($calendar->calendar(), $user,
            $calendarConfigResponse->typeDayOffCollection());

        $getLastDayOffFormRequestByUser = $this->getLastDayOffFormRequestByUser;
        $statusLastDayOffFormRequest = $getLastDayOffFormRequestByUser->__invoke(new LastDayOffFormRequestByUserRequest($user));

        $getDatesOfCalendar = $this->getDatesOfCalendar;
        $calendarInfo = $getDatesOfCalendar->__invoke(
            new DateTimeImmutable($calendarConfigResponse->initDate()),
            new DateTimeImmutable($calendarConfigResponse->endDate()),
            $calendarConfigResponse->feastdayCollection()
        );

        return $this->render('dashboard/dashboard.html.twig', [
            'calendar_info' => $calendarInfo,
            'working_days' => $calendarConfigResponse->workDays(),
            'dates' => $datesByTypeAndStatusCollection,
            'users_dayoff' => $usersOnDayOffTodayCollection,
            'remaining_day' => $remainingDaysTypes,
            'last_dayoff' => $statusLastDayOffFormRequest,
            'current_day' => date('Y-m-d')      // ! print current day with style in calendar
        ]);
    }

    private function remainingDays(Calendar $calendar, User $user, array $typeDayOffCollection): array
    {
        $dayOffOfCalendarRequest = new RemainingDaysOffRequest($calendar, $user,
            $typeDayOffCollection);
        $getRemainingDaysOffByUser = $this->getRemainingDaysOffByUser;
        $remainingDaysOffResponse = $getRemainingDaysOffByUser->__invoke($dayOffOfCalendarRequest);

        return $remainingDaysOffResponse->remainingDaysOff();
    }
}

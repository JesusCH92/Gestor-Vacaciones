<?php

declare(strict_types=1);

namespace App\DayOffForm\Infrastructure\Controller\Supervisor;

use App\Calendar\ApplicationService\CalendarByActualYear;
use App\Calendar\ApplicationService\DTO\CalendarConfigRequest;
use App\Calendar\ApplicationService\GetCalendarConfig;
use App\DayOffForm\ApplicationService\DTO\DatesDayOffByDepartmentByUserNameRequest;
use App\DayOffForm\ApplicationService\FindDatesDayOffFormByDepartmentByUserName;
use App\DayOffForm\ApplicationService\GetDatesOfCalendar;
use App\DayOffForm\Infrastructure\OrmUsersInDayOffFormRepository;
use DateTimeImmutable;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class FilterDayOffByDepartmentByName extends AbstractController
{
    private CalendarByActualYear $getCalendarByYear;
    private GetCalendarConfig $getCalendarConfig;
    private GetDatesOfCalendar $getDatesOfCalendar;
    private FindDatesDayOffFormByDepartmentByUserName $findDatesDayOffFormByDepartmentByUserName;

    public function __construct(
        CalendarByActualYear $getCalendarByYear,
        GetCalendarConfig $getCalendarConfig,
        GetDatesOfCalendar $getDatesOfCalendar,
        FindDatesDayOffFormByDepartmentByUserName $findDatesDayOffFormByDepartmentByUserName
    ) {
        $this->getCalendarByYear = $getCalendarByYear;
        $this->getCalendarConfig = $getCalendarConfig;
        $this->getDatesOfCalendar = $getDatesOfCalendar;
        $this->findDatesDayOffFormByDepartmentByUserName = $findDatesDayOffFormByDepartmentByUserName;
    }

    /**
     * @Route("/supervise/management/dayoff/employees/filter", methods={"GET"}, name="app_supervise_management_find_employees")
     */
    public function findUserInDayOff(Request $request)
    {
        if (!$request->isXmlHttpRequest()) {
            return new Response('not ajax', 404);
        }

        $request = $request->get('filterEmployeesCorpus');
        $departmentId = $request['department'];
        $userName = $request['user'];

        $calendarByYear = $this->getCalendarByYear;
        $currentYear = date("Y");
        $calendar = $calendarByYear->__invoke(intval($currentYear));

        if ('0' === $departmentId && '' === $userName) {
            $filtereDayOffFormType = OrmUsersInDayOffFormRepository::USERSINDAYOFF;
        } elseif ('0' !== $departmentId && '' === $userName) {
            $filtereDayOffFormType = OrmUsersInDayOffFormRepository::USERSINDAYOFFINDEPARTMENT;
        } elseif ('0' === $departmentId && '' !== $userName) {
            $filtereDayOffFormType = OrmUsersInDayOffFormRepository::USERSINDAYOFFBYNAME;
        } elseif ('0' !== $departmentId && '' !== $userName) {
            $filtereDayOffFormType = OrmUsersInDayOffFormRepository::USERSINDAYOFFBYNAMEINDEPARTMENT;
        }

        $findDatesDayOffFormByDepartmentByUserName = $this->findDatesDayOffFormByDepartmentByUserName;
        $datesDayOffFormResponse = $findDatesDayOffFormByDepartmentByUserName->__invoke(new DatesDayOffByDepartmentByUserNameRequest($calendar->calendar(),
            intval($departmentId), $userName, $filtereDayOffFormType));

        $getCalendarConfig = $this->getCalendarConfig;
        $calendarConfigResponse = $getCalendarConfig->__invoke(new CalendarConfigRequest($calendar->calendar()->calendarId()));

        $getDatesOfCalendar = $this->getDatesOfCalendar;

        $calendarInfo = $getDatesOfCalendar->__invoke(
            new DateTimeImmutable($calendarConfigResponse->initDate()),
            new DateTimeImmutable($calendarConfigResponse->endDate()),
            $calendarConfigResponse->feastdayCollection()
        );

        $dayOffConfigTemplate = $this->render('supervise_employees/supervise_search_day_off/list_employees_day_off.html.twig',
            [
                'calendar_info' => $calendarInfo,
                'working_days' => $calendarConfigResponse->workDays(),
                'dates_dayoff' => $datesDayOffFormResponse
            ])->getContent();

        return new JsonResponse([
            'dayoff_config' => $dayOffConfigTemplate
        ]);
    }
}
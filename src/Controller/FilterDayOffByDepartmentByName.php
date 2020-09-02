<?php


namespace App\Controller;

use App\Calendar\ApplicationService\CalendarByActualYear;
use App\Calendar\ApplicationService\DTO\CalendarConfigRequest;
use App\Calendar\ApplicationService\GetCalendarByYear;
use App\Calendar\ApplicationService\GetCalendarConfig;
use App\DayOffForm\ApplicationService\DTO\DatesDayOffByDepartmentByUserNameRequest;
use App\DayOffForm\ApplicationService\DTO\DayOffFormByCalendarRequest;
use App\DayOffForm\ApplicationService\DTO\RemainingDaysOffRequest;
use App\DayOffForm\ApplicationService\DTO\RemainingDaysOffResponse;
use App\DayOffForm\ApplicationService\FindDatesDayOffFormByDepartmentByUserName;
use App\DayOffForm\ApplicationService\GetDatesOfCalendar;
use App\DayOffForm\ApplicationService\GetDayOffFormByCalendar;
use App\Department\ApplicationService\DTO\DepartmentByIdRequest;
use App\Department\ApplicationService\GetAllDepartments;
use App\Department\ApplicationService\GetDepartmentById;
use App\Entity\Calendar;
use App\SuperviseEmployees\ApplicationService\DTO\UserByDepartmentRequest;
use App\User\ApplicationService\FindAllUsers;
use App\User\ApplicationService\FindUsersByDepartment;
use App\User\Domain\User;
use DateTimeImmutable;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     * @Route("/supervise/management/employees", name="app_supervise_management_find_employees")
     */
    public function findUserInDayOff(Request $request)
    {
        $request = $request->get('filterEmployeesCorpus');
        $department = $request['department'];
        $userName = $request['user'];

        $calendarByYear = $this->getCalendarByYear;
        $year = date("Y");
        $calendar = $calendarByYear->__invoke($year);


        /*if ('0' === $department && '' === $userName) {
            //buscar todos

            $findAllUsers = $this->findAllUsers;
            $usersCollection = $findAllUsers->__invoke();

        }
        if ('0' !== $department && '' === $userName) {
            //buscar por departamento
            $departmenById = $this->getDepartmentById;
            $departmentByNameResponse = $departmenById(new DepartmentByIdRequest($department));

            $usersByDepartment = $this->findUsersByDepartment;
            $usersCollection = $usersByDepartment->__invoke(new UserByDepartmentRequest($departmentByNameResponse->department()));

        }
        if ('0' === $department && '' !== $userName) {
            //buscar por nombre
        }
        if ('0' !== $department && '' !== $userName) {
            $datesByDepartmentByUserName = $this->findDatesDayOffFormByDepartmentByUserName;
            $datesDayOffFormResponse = $datesByDepartmentByUserName->__invoke(new DatesDayOffByDepartmentByUserNameRequest($calendar->calendar(), $department,$userName));
        }
*/
        $datesByDepartmentByUserName = $this->findDatesDayOffFormByDepartmentByUserName;
        $datesDayOffFormResponse = $datesByDepartmentByUserName->__invoke(new DatesDayOffByDepartmentByUserNameRequest($calendar->calendar(), $department,$userName));

        /*$dayOffFormByCalendar = $this->getDayOffFormByCalendar;
        $datesDayOffFormResponse = $dayOffFormByCalendar->__invoke(new DayOffFormByCalendarRequest($calendar->calendar(),
            $usersCollection->usersCollection()));
*/
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


        //return new Response('??');

    }

}
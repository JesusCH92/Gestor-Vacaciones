<?php


namespace App\Controller;

use App\Calendar\ApplicationService\DTO\CalendarConfigRequest;
use App\Calendar\ApplicationService\GetCalendarById;
use App\Calendar\ApplicationService\GetCalendarByYear;
use App\Calendar\ApplicationService\GetCalendarConfig;
use App\DayOffForm\ApplicationService\DTO\DayOffOfCalendarRequest;
use App\DayOffForm\ApplicationService\GetDatesOfCalendar;
use App\DayOffForm\ApplicationService\GetRemainingDaysOffByUser;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class DayOffFormByCalendarController extends AbstractController
{
    private GetCalendarById $getCalendarById;
    private GetCalendarConfig $getCalendarConfig;
    private GetDatesOfCalendar $getDatesOfCalendar;
    private GetRemainingDaysOffByUser $getRemainingDaysOffByUser;

    public function __construct(
        GetCalendarById $getCalendarById,
        GetCalendarConfig $getCalendarConfig,
        GetDatesOfCalendar $getDatesOfCalendar,
        GetRemainingDaysOffByUser $getRemainingDaysOffByUser
    ) {
        $this->getCalendarById = $getCalendarById;
        $this->getCalendarConfig = $getCalendarConfig;
        $this->getDatesOfCalendar = $getDatesOfCalendar;
        $this->getRemainingDaysOffByUser = $getRemainingDaysOffByUser;
    }

    /**
     * @Route("/dayoff/{id}", name="app_dayoff_config")
     */
    public function index($id)
    {
        $user = $this->getUser();

        /*$calendarByYear = $this->getCalendarByYear;
        $year = date("Y");
        $calendar = $calendarByYear->__invoke($year);
*/
        $calendarId = $id;


        $calendarRequest = new CalendarConfigRequest($calendarId);

        $getCalendarById = $this->getCalendarById;
        $calendarResponse = $getCalendarById->__invoke($calendarRequest);

        $getCalendarConfig = $this->getCalendarConfig;
        $calendarConfigResponse = $getCalendarConfig->__invoke($calendarRequest);

        $getDatesOfCalendar = $this->getDatesOfCalendar;

        // $feastday = [];
        // foreach($calendarConfigResponse->feastdayCollection() as $feastdayDate) {
        //     array_push($feastday, $feastdayDate['date']);
        // }
        $calendarInfo = $getDatesOfCalendar->__invoke(
            new DateTimeImmutable($calendarConfigResponse->initDate()),
            new DateTimeImmutable($calendarConfigResponse->endDate()),
            $calendarConfigResponse->feastdayCollection()
        );

        $dayOffOfCalendarRequest = new DayOffOfCalendarRequest($calendarResponse->calendar(), $user,
            $calendarConfigResponse->typeDayOffCollection());
        $getRemainingDaysOffByUser = $this->getRemainingDaysOffByUser;
        $remainingDaysOffResponse = $getRemainingDaysOffByUser->__invoke($dayOffOfCalendarRequest);


        $dayOffConfigTemplate = $this->render('dayoff_form/dayoff_form_request/_dayoff_request.html.twig', [
            'year' => '2020',
            'calendar' => $calendarConfigResponse,
            'remainig_days' => $remainingDaysOffResponse->remainingDaysOff(),
            'calendar_info' => $calendarInfo,
            'working_days' => $calendarConfigResponse->workDays()
        ])->getContent();

        return new JsonResponse([
            'dayoff_config' => $dayOffConfigTemplate
        ]);

    }
}
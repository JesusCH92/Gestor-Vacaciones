<?php

declare(strict_types=1);

namespace App\Calendar\Infrastructure\Controller;

use App\Calendar\ApplicationService\CreateCalendarConfig;
use App\Calendar\ApplicationService\DTO\CalendarRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class CreateCalendarController extends AbstractController
{
    private CreateCalendarConfig $createCalendarConfig;

    public function __construct(CreateCalendarConfig $createCalendarConfig)
    {
        $this->createCalendarConfig = $createCalendarConfig;
    }

    /**
     * @Route("/calendar/management/create/calendar", methods={"POST"}, name="app_create_calendar")
     */
    public function create(Request $request)
    {
        $calendarConfig = $request->get('calendar');

        $workingYear = $calendarConfig['workingYear'];
        $initDateRequest = $calendarConfig['initDateRequest'];
        $endDateRequest = $calendarConfig['endDateRequest'];
        $holidaysNumber = $calendarConfig['holidaysNumber'];
        $personalDaysNumber = $calendarConfig['personalDaysNumber'];
        $workDays = $calendarConfig['workDays'] === '' ? [] : $calendarConfig['workDays'];
        $feastdayCollection = $calendarConfig['feastDayCollection'] === '' ? [] : $calendarConfig['feastDayCollection'];


        $company = $this->getUser()->getCompany();

        $calendarRequest = new CalendarRequest(
            $workingYear,
            $initDateRequest,
            $endDateRequest,
            $holidaysNumber,
            $personalDaysNumber,
            $workDays,
            $feastdayCollection,
            $company
        );

        $createCalendarConfig = $this->createCalendarConfig;
        $createCalendarConfig->__invoke($calendarRequest);


        // return new JsonResponse([
        //     'calendar_created' => 'OK'
        // ]);
        return Response::create('create calendar config');
    }
}

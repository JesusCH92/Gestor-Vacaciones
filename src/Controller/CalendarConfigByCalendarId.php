<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Calendar\ApplicationService\DTO\CalendarConfigRequest;
use App\Calendar\ApplicationService\GetCalendarConfig;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class CalendarConfigByCalendarId extends AbstractController
{
    private GetCalendarConfig $getCalendarConfig;

    public function __construct(GetCalendarConfig $getCalendarConfig)
    {
        $this->getCalendarConfig = $getCalendarConfig;
    }

    /**
     * @Route("/calendar/management/config/{id}", name="app_calendar_config_by_id", methods={"GET"})
     */
    public function index($id)
    {
        // dump($id);
        // $company = $this->getUser()->getCompany();
        $calendarId = $id;

        $calendarConfigRequest = new CalendarConfigRequest($calendarId);
        $getCalendarConfig = $this->getCalendarConfig;
        $calendarConfigResponse = $getCalendarConfig->__invoke($calendarConfigRequest);

        //->getContent();
        $calendarConfigTemplate = $this->render('calendar_management/_edit_calendar_config.html.twig', [
            'calendar_config' => $calendarConfigResponse,
        ])->getContent();

        // return $this->render('calendar_management/_edit_calendar_config.html.twig', [
        //     'calendar_config' => $calendarConfigResponse,
        // ]);
        return new JsonResponse([
            'calendar_config' => $calendarConfigTemplate
        ]);
    }
}
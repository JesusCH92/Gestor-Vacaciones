<?php

declare(strict_types=1);

namespace App\Calendar\Infrastructure\Controller;

use App\Calendar\ApplicationService\GetAllCalendar;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class EditCalendarConfigController extends AbstractController
{
    private GetAllCalendar $getAllCalendar;

    public function __construct(GetAllCalendar $getAllCalendar)
    {
        $this->getAllCalendar = $getAllCalendar;
    }

    /**
     * @Route("/calendar/management/edit/calendar", name="app_edit_calendar", methods={"GET"})
     */
    public function edit()
    {
        $adminUser = $this->getUser();
        $company = $adminUser->getCompany();

        $getAllCalendar = $this->getAllCalendar;
        $calendarCollectionResponse = $getAllCalendar->__invoke($company);

        return $this->render('calendar_management/edit_calendar.html.twig', [
            'calendar_by_working_year' => $calendarCollectionResponse,
        ]);
    }
}
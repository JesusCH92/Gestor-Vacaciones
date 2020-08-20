<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Calendar\ApplicationService\WorkDaysUpdater;
use App\Company\ApplicationService\DTO\WorkDaysRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class WorkDaysUpdaterController extends AbstractController
{
    private WorkDaysUpdater $workDaysUpdater;

    public function __construct(WorkDaysUpdater $workDaysUpdater)
    {
        $this->workDaysUpdater = $workDaysUpdater;
    }

    /**
     * @Route("/calendar/management/update/workDays", name="app_workdays_update", methods={"PUT"})
     */
    public function updateWorkDays(Request $request)
    {
        $workDays = $request->get('workDays');
        $calendarId = $workDays['calendarId'];
        $workDays = "" === $workDays['workDays'] ? [] : $workDays['workDays'];

        $workDaysRequest = new WorkDaysRequest(
            $calendarId,
            $workDays
        );

        $workDaysUpdater = $this->workDaysUpdater;
        $workDaysUpdater->__invoke($workDaysRequest);

        return new Response('update work days in Calendar');
    }
}
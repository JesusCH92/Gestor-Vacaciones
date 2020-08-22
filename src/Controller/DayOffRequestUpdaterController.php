<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Calendar\ApplicationService\DayOffConfigUpdater;
use App\Calendar\ApplicationService\DTO\DayOffConfigRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class DayOffRequestUpdaterController extends AbstractController
{
    private DayOffConfigUpdater $dayOffConfigUpdater;

    public function __construct(DayOffConfigUpdater $dayOffConfigUpdater)
    {
        $this->dayOffConfigUpdater = $dayOffConfigUpdater;
    }

    /**
     * @Route("/calendar/management/dayoffrequest", name="app_dayoff_request_update", methods={"PUT"})
     */
    public function updateDayOffRequest(Request $request)
    {
        $calendarConfig = $request->get('dayOffRequest');
        $calendarId = $calendarConfig['calendarId'];
        $initDateDayOff = $calendarConfig['initDateRequest'];
        $endDateDayOff = $calendarConfig['endDateRequest'];

        $dayOffConfigRequest = new DayOffConfigRequest(
            $initDateDayOff,
            $endDateDayOff,
            $calendarId
        );

        $dayOffConfigUpdater = $this->dayOffConfigUpdater;
        $dayOffConfigUpdater->__invoke($dayOffConfigRequest);

        return new Response('update day off request in calendar');
    }
}
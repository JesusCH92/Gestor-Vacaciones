<?php

namespace App\Controller;

use App\DayOff\ApplicationService\DayOffRequest;
use App\DayOff\ApplicationService\SaveDayOffRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class DayOffRequestController extends AbstractController
{
    private SaveDayOffRequest $saveDayOffRequest;

    public function __construct(SaveDayOffRequest $saveDayOffRequest)
    {
        $this->saveDayOffRequest = $saveDayOffRequest;
    }

    /**
     * @Route("/dayoff/add", options={"expose"=true}, name="app_day_off")
     */
    public function dayOff(Request $request)
    {
        $user = $this->getUser();

        $request = $request->get('day_off_request');

        /*! AS -> GET DAY OFF REMAINING BY USER BY DAY TYPE */

        $saveDayOffRequest = $this->saveDayOffRequest;
        $saveDayOffRequest(
            new DayOffRequest(
                $user,
                $request['type_of_day'],
                $request['count_day_off'],
                json_decode($request['days_off'])
            )
        );

        return Response::create('??');
    }
}
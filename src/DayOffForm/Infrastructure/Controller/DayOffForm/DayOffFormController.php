<?php

declare(strict_types=1);

namespace App\DayOffForm\Infrastructure\Controller\DayOffForm;

use App\Calendar\ApplicationService\GetCalendarByYear;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class DayOffFormController extends AbstractController
{
    private GetCalendarByYear $getCalendarByYear;

    public function __construct(
        GetCalendarByYear $getCalendarByYear
    ) {
        $this->getCalendarByYear = $getCalendarByYear;
    }

    /**
     * @Route("/dayoff/request", methods={"GET"}, name="app_dayoff")
     */
    public function index()
    {

        $calendarByYear = $this->getCalendarByYear;
        $year = date("Y");
        $calendar = $calendarByYear->__invoke(intval($year));

        return $this->render('dayoff_form/dayoff.html.twig', [
            'calendars' => $calendar
        ]);

    }


}
<?php


namespace App\Controller;

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
     * @Route("/dayoff", name="app_dayoff")
     */
    public function index()
    {
        $user = $this->getUser();

        $calendarByYear = $this->getCalendarByYear;
        $year = date("Y");
        $calendar = $calendarByYear->__invoke($year);


        return $this->render('dayoff_form/dayoff.html.twig', [
            'calendars' => $calendar
        ]);

    }


}
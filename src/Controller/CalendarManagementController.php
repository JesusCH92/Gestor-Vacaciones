<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class CalendarManagementController extends AbstractController
{
    /**
     * @Route("/calendar/management", name="app_calendar_management")
     */
    public function index()
    {
        return $this->render('calendar_management/create_calendar.html.twig', [
            'controller_name' => 'CreateCalendarController',
        ]);
    }
}

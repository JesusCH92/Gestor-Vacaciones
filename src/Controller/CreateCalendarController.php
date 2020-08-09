<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CreateCalendarController extends AbstractController
{
    /**
     * @Route("/calendar/management/create/calendar", name="app_create_calendar")
     */
    public function index()
    {
        return $this->render('calendar_management/create_calendar.html.twig', [
            'controller_name' => 'CreateCalendarController',
        ]);
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SearchDayOffByUserController extends AbstractController
{
    /**
     * @Route("/supervise/dayoff/employees", name="supervise_day_off_employee")
     */
    public function index()
    {
        return $this->render('supervise_employees/supervise_search_day_off/search-employee-day-off.twig', [

        ]);

    }
}

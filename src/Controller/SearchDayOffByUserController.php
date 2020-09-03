<?php

namespace App\Controller;

use App\Department\ApplicationService\GetAllDepartments;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SearchDayOffByUserController extends AbstractController
{
    private GetAllDepartments $getAllDepartments;

    public function __construct(GetAllDepartments $getAllDepartments)
    {
        $this->getAllDepartments = $getAllDepartments;
    }

    /**
     * @Route("/supervise/management/dayoff/employees", name="supervise_day_off_employee")
     */
    public function index()
    {
        $getAllDepartments = $this->getAllDepartments;
        $departmentCollection = $getAllDepartments->__invoke();

        return $this->render('supervise_employees/supervise_search_day_off/search-employee-day-off.twig', [
            'department' => $departmentCollection->departmentCollection()
        ]);

    }
}

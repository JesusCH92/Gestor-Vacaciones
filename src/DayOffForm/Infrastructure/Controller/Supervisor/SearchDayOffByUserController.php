<?php

declare(strict_types=1);

namespace App\DayOffForm\Infrastructure\Controller\Supervisor;

use App\Department\ApplicationService\GetAllDepartments;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class SearchDayOffByUserController extends AbstractController
{
    private GetAllDepartments $getAllDepartments;

    public function __construct(GetAllDepartments $getAllDepartments)
    {
        $this->getAllDepartments = $getAllDepartments;
    }

    /**
     * @Route("/supervise/management/dayoff/employees", methods={"GET"}, name="app_supervise_day_off_employee")
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

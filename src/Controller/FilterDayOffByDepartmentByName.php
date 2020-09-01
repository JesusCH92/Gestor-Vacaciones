<?php


namespace App\Controller;

use App\Department\ApplicationService\GetAllDepartments;
use App\Department\ApplicationService\GetDepartmentByName;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class FilterDayOffByDepartmentByName extends AbstractController
{
    private GetAllDepartments $getAllDepartments;
    private GetDepartmentByName $getDepartmentByName;

    public function __construct(GetAllDepartments $getAllDepartments,  GetDepartmentByName $getDepartmentByName)
    {
        $this->getAllDepartments = $getAllDepartments;
        $this->getDepartmentByName = $getDepartmentByName;
    }

    /**
     * @Route("/supervise/management/employees", name="app_supervise_management_find_employees")
     */
    public function findUserInDayOff(Request $request)
    {
        $request = $request->get('filterEmployeesCorpus');
        $department = $request['department'];
        $userName = $request['user'];
        var_dump($department);
        var_dump($userName);
        return new Response('??');

    }
}
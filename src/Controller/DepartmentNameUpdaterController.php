<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Department\ApplicationService\DepartmentNameUpdater;
use App\Department\ApplicationService\DTO\DepartmentNameRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class DepartmentNameUpdaterController extends AbstractController
{
    private DepartmentNameUpdater $departmentNameUpdater;

    public function __construct(DepartmentNameUpdater $departmentNameUpdater)
    {
        $this->departmentNameUpdater = $departmentNameUpdater;
    }

    /**
     * @Route("/company/management/edit/department/name", name="app_department_name_update", methods={"POST"})
     */   
    public function departmentNameUpdate(Request $request)
    {
        $department = $request->get('department');

        $departmentName = $department['name'];
        $departmentId = $department['id'];

        $this->departmentNameUpdater->__invoke(
            new DepartmentNameRequest(
                $departmentId,
                $departmentName
            )
        );

        return Response::create('department name updated');
    }
}
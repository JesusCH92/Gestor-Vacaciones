<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Department\ApplicationService\DepartmentCodeUpdater;
use App\Department\ApplicationService\DTO\DepartmentCodeRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class DepartmentCodeUpdaterController extends AbstractController
{
    private DepartmentCodeUpdater $departmentCodeUpdater;

    public function __construct(DepartmentCodeUpdater $departmentCodeUpdater)
    {
        $this->departmentCodeUpdater = $departmentCodeUpdater;
    }

    /**
     * @Route("/company/management/edit/department/code", name="app_department_code_update", methods={"POST"})
     */ 
    public function departmentCodeUpdate(Request $request)
    {
        $department = $request->get('department');

        $departmentName = $department['code'];
        $departmentId = $department['id'];

        $this->departmentCodeUpdater->__invoke(
            new DepartmentCodeRequest(
                $departmentId,
                $departmentName
            )
        );
        

        return Response::create('department code update');
    }
}
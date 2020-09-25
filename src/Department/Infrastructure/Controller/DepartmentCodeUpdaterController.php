<?php

declare(strict_types=1);

namespace App\Department\Infrastructure\Controller;

use App\Department\ApplicationService\DepartmentCodeUpdater;
use App\Department\ApplicationService\DTO\DepartmentCodeRequest;
use App\Department\ApplicationService\Exception\DepartmentCodeIsNotValidException;
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

        $departmentCode = $department['code'];
        $departmentId = $department['id'];

        if ("" === $departmentCode || strlen($departmentCode) > 10) {
            throw new DepartmentCodeIsNotValidException($departmentCode);
        }


        $this->departmentCodeUpdater->__invoke(
            new DepartmentCodeRequest(
                $departmentId,
                $departmentCode
            )
        );


        return Response::create('department code update');
    }
}
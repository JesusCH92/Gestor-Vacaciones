<?php

declare(strict_types = 1);

namespace App\Company\Infrastructure\Controller;

use App\Company\ApplicationService\CreateDepartment;
use App\Company\ApplicationService\DTO\DepartmentRequest;
use App\Company\ApplicationService\GetAllDepartmentsByAdmin;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class CompanyManagementController extends AbstractController
{
    private GetAllDepartmentsByAdmin $getAllDepartmentsByAdmin;
    private CreateDepartment $createDepartment;

    public function __construct(GetAllDepartmentsByAdmin $getAllDepartmentsByAdmin, CreateDepartment $createDepartment)
    {
        $this->getAllDepartmentsByAdmin = $getAllDepartmentsByAdmin;
        $this->createDepartment = $createDepartment;
    }

    /**
     * @Route("/company/management", methods={"GET"}, name="app_company_management")
     */
    public function index()
    {
        $adminUser = $this->getUser();

        $departmentCollectionService = $this->getAllDepartmentsByAdmin;
        $departmentCollectionByAdmin = $departmentCollectionService($adminUser);

        return $this->render('company_management/companyEdit.html.twig', [
            'department_collection' => $departmentCollectionByAdmin,
        ]);
    }

    /**
     * @Route("/company/management/add/department", methods={"POST"}, options={"expose"=true}, name="app_add_department")
     */
    public function addDepartment(Request $request)
    {
        if(!$request->isXmlHttpRequest()){
            return new Response('not ajax', 404);
        }

        $department = $request->get('department');
        $departmentName = $department['name'];
        $departmentCode = $department['code'];

        $companyId = intval( $this->getUser()->getCompany()->companyId() );

        $departmentRequest = new DepartmentRequest(
            $companyId,
            $departmentName,
            $departmentCode
        );

        $createDepartment = $this->createDepartment;
        $departmentCreated = $createDepartment->__invoke($departmentRequest);

        $departmentTemplate = $this->render('company_management/_department.html.twig', [
            'department' => $departmentCreated,
        ])->getContent();

        return new JsonResponse([
            'department_created' => $departmentTemplate
        ]);
    }
}

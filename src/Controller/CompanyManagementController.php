<?php

namespace App\Controller;

use App\Company\ApplicationService\CreateDepartment;
use App\Company\ApplicationService\DTO\DepartmentRequest;
use App\Company\ApplicationService\GetAllDepartmentsByAdmin;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompanyManagementController extends AbstractController
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
        // dump($this->getUser()->getCompany()->getId());exit;
        $adminUser = $this->getUser();

        $departmentCollectionService = $this->getAllDepartmentsByAdmin;
        $departmentCollectionByAdmin = $departmentCollectionService($adminUser);

        return $this->render('company_management/companyEdit.html.twig', [
            'department_collection' => $departmentCollectionByAdmin,
        ]);
    }

    /**
     * @Route("/company/management/add/department", options={"expose"=true}, name="app_add_department")
     */
    public function addDepartment(Request $request)
    {
        if(!$request->isXmlHttpRequest()){
            return new Response('not ajax', 404);
        }

        $department = $request->get('department');
        $departmentName = $department['name'];
        $departmentCode = $department['code'];

        // dump($this->getUser());exit;
        $companyId = intval( $this->getUser()->getCompany()->companyId() );
        // $companyId = 1;
        // echo 'aqui' . PHP_EOL;exit;

        $departmentRequest = new DepartmentRequest(
            $companyId,
            $departmentName,
            $departmentCode
        );

        $createDepartment = $this->createDepartment;
        $departmentCreated = $createDepartment->__invoke($departmentRequest);

        // echo json_encode($departmentCreated) . PHP_EOL;
        // echo $departmentCreated->departmentName() . PHP_EOL;

        $departmentTemplate = $this->render('company_management/_department.html.twig', [
            'department' => $departmentCreated,
        ])->getContent();

        return new JsonResponse([
            'department_created' => $departmentTemplate
        ]);

        // return new Response('ddd');
        // return Response::create('???');
    }
}

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
     * @Route("/company/management", name="app_company_management")
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

        $companyId = intval( $this->getUser()->getCompany()->getId() );

        $departmentRequest = new DepartmentRequest(
            $companyId,
            $departmentName,
            $departmentCode
        );

        echo json_encode($departmentRequest) . PHP_EOL;
        // var_dump($departmentRequest)

        $createDepartment = $this->createDepartment;
        $createDepartment->__invoke($departmentRequest);

        // return new JsonResponse([
        //     'say' => 'General Kenobi',
        //     'department_format' => 'esto será un twig'
        // ]);

        // return new Response('ddd');
        return Response::create('???');
    }
}

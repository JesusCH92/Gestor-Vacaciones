<?php

declare(strict_types = 1);

namespace App\User\Infrastructure\Controller;

use App\Company\ApplicationService\GetAllDepartmentsByAdmin;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class UserSearcherViewController extends AbstractController
{
    private GetAllDepartmentsByAdmin $getAllDepartmentsByAdmin;

    public function __construct(GetAllDepartmentsByAdmin $getAllDepartmentsByAdmin)
    {
        $this->getAllDepartmentsByAdmin = $getAllDepartmentsByAdmin;
    }

    /**
     * @Route("/user/management/edit/view", name="app_user_searcher_view")
     */
    public function index()
    {
        $adminUser = $this->getUser();

        $departmentCollectionService = $this->getAllDepartmentsByAdmin;
        $departmentCollectionByAdmin = $departmentCollectionService->__invoke($adminUser);

        return $this->render('user_searcher/edit_user_view.html.twig', [
            'department_collection' => $departmentCollectionByAdmin->departments(),
        ]);
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CompanyManagementController extends AbstractController
{
    /**
     * @Route("/company/management", name="app_company_management")
     */
    public function index()
    {
        return $this->render('company_management/index.html.twig', [
            'controller_name' => 'CompanyManagementController',
        ]);
    }
}

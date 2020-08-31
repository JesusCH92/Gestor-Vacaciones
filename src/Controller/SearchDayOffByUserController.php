<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SearchDayOffByUserController extends AbstractController
{
    /**
     * @Route("/search/day/off/by/user", name="search_day_off_by_user")
     */
    public function index()
    {
        return $this->render('search_day_off_by_user/index.html.twig', [
            'controller_name' => 'SearchDayOffByUserController',
        ]);
    }
}

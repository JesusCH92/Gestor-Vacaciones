<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile", name="app_profile")
     */
    public function profile()
    {
        $user = $this->getUser();

        $nameInitial = strtoupper($user->getName()[0]);
        $lastNameInitial = strtoupper($user->getLastName()[0]);

        return $this->render(
            'profile/profile.html.twig',
            [
                'user' => $user,
                'nameInitial' => $nameInitial,
                'lastNameInitial' => $lastNameInitial
            ]
        );
    }

}
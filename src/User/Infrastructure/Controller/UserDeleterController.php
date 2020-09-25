<?php

declare(strict_types = 1);

namespace App\User\Infrastructure\Controller;

use App\User\ApplicationService\DTO\UserByIdRequest;
use App\User\ApplicationService\UserDeleter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class UserDeleterController extends AbstractController
{
    private UserDeleter $userDeleter;

    public function __construct(UserDeleter $userDeleter)
    {
        $this->userDeleter = $userDeleter;
    }

    /**
     * @Route("/user/management/delete/{id}", name="app_user_delete", methods={"DELETE"})
     */
    public function userDelete($id)
    {

        $userDeleter = $this->userDeleter;
        $userDeleter->__invoke( new UserByIdRequest($id) );
        
        return Response::create("user delete");
    }
}
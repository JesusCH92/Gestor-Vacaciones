<?php

declare(strict_types = 1);

namespace App\Controller;

use App\User\ApplicationService\DTO\UserByIdRequest;
use App\User\ApplicationService\DTO\UserByIdResponse;
use App\User\ApplicationService\FindUserById;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class UserSearcherByIdController extends AbstractController
{
    private FindUserById $findUserById;

    public function __construct(FindUserById $findUserById)
    {
        $this->findUserById = $findUserById;
    }

    /**
     * @Route("/user/management/filter/id/{id}", name="app_filtering_user_by_id", methods={"GET"})
     */
    public function getUserFormById($id)
    {
        $userId = $id;

        $findUserById = $this->findUserById;
        $user = $findUserById->__invoke(
            new UserByIdRequest($userId)
        );

        $userResponse = new UserByIdResponse(
            $user->name(),
            $user->lastname(),
            $user->email(),
            $user->phone(),
            $user->getCompany()->companyName(),
            $user->getDepartment()->departmentName(),
            $user->roles()->roles()[0]
        );
        
        // dump($userResponse);

        // dump($user->roles()->roles()[0]);

        $userFormTemplate = $this->render('user_management/edit_user_form.html.twig', [
            'user_info' => $userResponse,
        ])->getContent();

        // return Response::create('user list searched');
        return new JsonResponse([
            'user_form_template' => $userFormTemplate
        ]);
    }
}
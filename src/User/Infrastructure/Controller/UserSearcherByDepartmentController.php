<?php

declare(strict_types = 1);

namespace App\User\Infrastructure\Controller;

use App\User\ApplicationService\DTO\UserByDepartmentRequest;
use App\User\ApplicationService\GetUserByDepartment;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

final class UserSearcherByDepartmentController extends AbstractController
{
    private GetUserByDepartment $getUserByDepartment;

    public function __construct(GetUserByDepartment $getUserByDepartment)
    {
        $this->getUserByDepartment = $getUserByDepartment;
    }

    /**
     * @Route("/user/management/filtering", name="app_filtering_user_by_department", methods={"GET"})
     */
    public function filteringUserByDepartment(Request $request)
    {
        $userByDepartmentRequest = $request->get('userSearchedCorpus');
        $userName = $userByDepartmentRequest['username'];
        $department = $userByDepartmentRequest['department'];

        $getUserByDepartment = $this->getUserByDepartment;
        $usersCollection = $getUserByDepartment->__invoke(
            new UserByDepartmentRequest(
                $userName,
                $department
            )
        );

        $userCollectionTemplate = $this->render('user_searcher/filtering_user_container/filtering_user_container.html.twig', [
            'user_collection' => $usersCollection,
        ])->getContent();

        return new JsonResponse([
            'user_collection_template' => $userCollectionTemplate
        ]);
    }
}
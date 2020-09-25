<?php

declare(strict_types=1);

namespace App\User\Infrastructure\Controller;

use App\User\ApplicationService\DTO\UserRoleRequest;
use App\User\ApplicationService\UserRoleEditor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class UserRoleEditorController extends AbstractController
{
    private UserRoleEditor $userRoleEditor;

    public function __construct(UserRoleEditor $userRoleEditor)
    {
        $this->userRoleEditor = $userRoleEditor;
    }

    /**
     * @Route("/user/management/rol", name="app_user_rol_update", methods={"PUT"})
     */
    public function userRoleUpdate(Request $request)
    {
        $userCorpusRequest = $request->get('userCorpus');
        $userId = $userCorpusRequest['id'];
        $userRole = $userCorpusRequest['rol'];

        $userRoleEditor = $this->userRoleEditor;
        $userRoleEditor->__invoke(
            new UserRoleRequest(
                $userId,
                $userRole
            )
        );

        return Response::create("user role '$userRole' update");
    }
}
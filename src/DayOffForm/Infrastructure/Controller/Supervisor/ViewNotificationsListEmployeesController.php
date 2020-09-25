<?php

declare(strict_types=1);

namespace App\DayOffForm\Infrastructure\Controller\Supervisor;

use App\DayOffForm\ApplicationService\DTO\UserByDepartmentRequest;
use App\DayOffForm\ApplicationService\GetUsersWithPendingStatus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class ViewNotificationsListEmployeesController extends AbstractController
{
    private GetUsersWithPendingStatus $getUsersWithPendingStatus;

    public function __construct(GetUsersWithPendingStatus $getUsersWithPendingStatus)
    {
        $this->getUsersWithPendingStatus = $getUsersWithPendingStatus;
    }

    /**
     * @Route("/supervise/management/notification/list", methods={"GET"}, name="app_notifications_list")
     */
    public function index()
    {
        $user = $this->getUser();
        $getUsersWithPendingStatus = $this->getUsersWithPendingStatus;
        $userByDepartmentResponse = $getUsersWithPendingStatus->__invoke(new UserByDepartmentRequest($user->getDepartment()));
        return $this->render('supervise_employees/notification-list.html.twig', [
            'users' => $userByDepartmentResponse->usersCollection()
        ]);
    }
}
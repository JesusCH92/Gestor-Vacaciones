<?php


namespace App\Controller;


use App\SuperviseEmployees\ApplicationService\DTO\UserByDepartmentRequest;
use App\SuperviseEmployees\ApplicationService\GetUsersWithPendingStatus;
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
     * @Route("/notification/list/employees", name="app_notifications_list")
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
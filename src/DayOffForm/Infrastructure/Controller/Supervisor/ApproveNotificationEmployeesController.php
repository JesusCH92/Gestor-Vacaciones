<?php

declare(strict_types=1);

namespace App\DayOffForm\Infrastructure\Controller\Supervisor;

use App\DayOffForm\ApplicationService\ApproveDayOffForm;
use App\DayOffForm\ApplicationService\DTO\ApproveDayOffFormRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class ApproveNotificationEmployeesController extends AbstractController
{
    private ApproveDayOffForm $approveDayOffForm;

    public function __construct(ApproveDayOffForm $approveDayOffForm)
    {
        $this->approveDayOffForm = $approveDayOffForm;
    }

    /**
     * @Route("/supervise/management/notification/approve", methods={"POST"}, name="app_notification_supervise_approve")
     */
    public function dayOff(Request $request)
    {
        $user = $this->getUser();

        $request = $request->get('day_off');

        $observation = $request['comment'];
        $dayOffId = $request['day_off_id'];
        $approveDayOffForm = $this->approveDayOffForm;
        $approveDayOffForm->__invoke(new ApproveDayOffFormRequest($dayOffId, $user->userId(), $observation));

        return Response::create('Approved');
    }

}
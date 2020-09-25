<?php

declare(strict_types=1);

namespace App\DayOffForm\Infrastructure\Controller\Supervisor;

use App\DayOffForm\ApplicationService\DenyDayOffForm;
use App\DayOffForm\ApplicationService\DTO\DenyDayOffFormRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class DenyNotificationEmployeesController extends AbstractController
{
    private DenyDayOffForm $denyDayOffForm;

    public function __construct(DenyDayOffForm $denyDayOffForm)
    {
        $this->denyDayOffForm = $denyDayOffForm;
    }

    /**
     * @Route("/supervise/management/notification/deny", methods={"POST"}, name="app_notification_supervise_denied")
     */
    public function dayOff(Request $request)
    {
        $user = $this->getUser();

        $request = $request->get('day_off');

        $observation = $request['comment'];
        $dayOffId = $request['day_off_id'];
        $denyDayOffForm = $this->denyDayOffForm;
        $denyDayOffForm->__invoke(new DenyDayOffFormRequest($dayOffId, $user->userId(), $observation));


        return Response::create('Denied');
    }
}
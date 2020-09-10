<?php


namespace App\Controller;


use App\SuperviseEmployees\ApplicationService\DTO\DayOffFormRequest;
use App\SuperviseEmployees\ApplicationService\GetDayOffFormRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class SuperviseEmployeesByDayOffController extends AbstractController
{
    private GetDayOffFormRequest $getDayOffFormRequest;

    public function __construct(GetDayOffFormRequest $getDayOffFormRequest)
    {
        $this->getDayOffFormRequest = $getDayOffFormRequest;
    }

    /**
     * @Route("supervise/management/notification/employees/dayoff/{id}", methods={"GET"}, name="app_dayoff_notification")
     */
    public function dayOff($id)
    {
        $dayOffFormRequest = new DayOffFormRequest($id);
        $getDayOffFormRequest = $this->getDayOffFormRequest;
        $dayOffFormResponse = $getDayOffFormRequest->__invoke($dayOffFormRequest);

        $dayOffConfigTemplate = $this->render('supervise_employees/notification-day-off.html.twig', [
            'dayoff' => $dayOffFormResponse->dayOffForm(),
            'dayOffRequest' => $dayOffFormResponse->dayOffFormRequest()
        ])->getContent();

        return new JsonResponse([
            'dayoff_config' => $dayOffConfigTemplate
        ]);

    }
}
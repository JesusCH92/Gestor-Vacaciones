<?php

declare(strict_types=1);

namespace App\Feastday\Infrastructure\Controller;

use App\Feastday\ApplicationService\DTO\FeastdayRequest;
use App\Feastday\ApplicationService\FeastdayCreator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

final class FeastdayCreatorController extends AbstractController
{
    private FeastdayCreator $feastdayCreator;

    public function __construct(FeastdayCreator $feastdayCreator)
    {
        $this->feastdayCreator = $feastdayCreator;
    }

    /**
     * @Route("/calendar/management/add/feastday", name="app_feastday_create", methods={"POST"})
     */
    public function feastdayCreate(Request $request)
    {
        $feastday = $request->get('feastday');
        $calendarId = $feastday['calendarId'];
        $feastdayDate = $feastday['date'];

        $feastdayRequest = new FeastdayRequest(
            $calendarId,
            $feastdayDate
        );

        $feastdayCreator = $this->feastdayCreator;
        $feastdayCreated = $feastdayCreator->__invoke($feastdayRequest);

        $feastdayTemplate = $this->render('calendar_management/feastday_item/feastday_item.html.twig', [
            'feastday' => $feastdayCreated->date(),
        ])->getContent();

        return new JsonResponse([
            'feastday_created' => $feastdayTemplate
        ]);
    }
}
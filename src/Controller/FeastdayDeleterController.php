<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Feastday\ApplicationService\DTO\FeastdayRequest;
use App\Feastday\ApplicationService\FeastdayDeleter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class FeastdayDeleterController extends AbstractController
{
    private FeastdayDeleter $feastdayDeleter;

    public function __construct(FeastdayDeleter $feastdayDeleter)
    {
        $this->feastdayDeleter = $feastdayDeleter;
    }

    /**
     * @Route("/calendar/management/delete/feastday", name="app_feastday_delete", methods={"DELETE"})
     */
    public function feastdayDelete(Request $request)
    {
        $feastday = $request->get('feastday');
        $calendarId = $feastday['calendarId'];
        $feastdayDate = $feastday['date'];

        $feastdayRequest = new FeastdayRequest(
            $calendarId,
            $feastdayDate
        );

        $feastdayDeleter = $this->feastdayDeleter;
        $feastdayDeleter->__invoke($feastdayRequest);

        return new Response('feastday deleted');
    }
}
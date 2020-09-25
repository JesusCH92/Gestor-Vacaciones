<?php

declare(strict_types = 1);

namespace App\TypeDayOff\Infrastructure\Controller;

use App\TypeDayOff\ApplicationService\DTO\TypeDayOffRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\TypeDayOff\ApplicationService\TypeDayOffNumberUpdater;

final class TypeDayOffNumerUpdaterController extends AbstractController
{
    private TypeDayOffNumberUpdater $typeDayOffNumberUpdater;

    public function __construct(TypeDayOffNumberUpdater $typeDayOffNumberUpdater)
    {
        $this->typeDayOffNumberUpdater = $typeDayOffNumberUpdater;
    }

    /**
     * @Route("/calendar/management/typeDayOff", name="app_typeDayOff_update", methods={"PUT"})
     */
    public function typeDayOffNumberUpdater(Request $request)
    {
        $typeDayOff = $request->get('typeDayOff');
        $calendarId = $typeDayOff['calendarId'];
        $type = $typeDayOff['type'];
        $number = $typeDayOff['number'];

        $typeDayOffRequest = new TypeDayOffRequest(
            $calendarId,
            $type,
            $number
        );

        $typeDayOffNumberUpdater = $this->typeDayOffNumberUpdater;
        $typeDayOffNumberUpdater->__invoke($typeDayOffRequest);

        return new Response('type day off number update');
    }
}
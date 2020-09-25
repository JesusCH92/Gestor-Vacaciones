<?php

declare(strict_types=1);

namespace App\Calendar\Infrastructure;

use App\Calendar\ApplicationService\DTO\CalendarConfigRequest;
use App\Calendar\Domain\CalendarConfigRepository;
use App\Entity\Calendar;
use App\Entity\FeastDay;
use App\Entity\TypeDayOff;
use Doctrine\ORM\EntityManagerInterface;

final class OrmCalendarConfigRepository implements CalendarConfigRepository
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getCalendarByCalendarId(CalendarConfigRequest $calendarConfigRequest): Calendar
    {
        $calendarId = $calendarConfigRequest->calendarId();

        $calendarRepository = $this->entityManager->getRepository(Calendar::class);
        $calendar = $calendarRepository->find($calendarId); // ! si lo encuentra devuelve la entidad, de lo contrario devuelve null
        // dump($calendar);exit;
        // $calendarEntity = [] === $calendar ? null : $calendar[0];

        return $calendar;
    }

    public function getFeastdayByCalendarId(CalendarConfigRequest $calendarConfigRequest): array
    {
        $calendarId = $calendarConfigRequest->calendarId();

        $feastdayRepository = $this->entityManager->getRepository(FeastDay::class);
        $feastdayEntities = $feastdayRepository->findBy(
            [
                'calendar' => $calendarId
            ]
        );

        return $feastdayEntities;
    }

    public function getTypeDayOffByCalendarId(CalendarConfigRequest $calendarConfigRequest): array
    {
        $calendarId = $calendarConfigRequest->calendarId();

        $typeDayOffRepository = $this->entityManager->getRepository(TypeDayOff::class);
        $typeDayOffEntities = $typeDayOffRepository->findBy(
            [
                'calendar' => $calendarId
            ]
        );

        $typeDayOffEntitiesCollection = [] === $typeDayOffEntities ? null : $typeDayOffEntities;

        return $typeDayOffEntitiesCollection;
    }
}
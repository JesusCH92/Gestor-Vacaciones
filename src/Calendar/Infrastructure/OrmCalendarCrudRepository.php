<?php

declare(strict_types=1);

namespace App\Calendar\Infrastructure;

use App\Calendar\Domain\CalendarUpdaterRepository;
use App\Entity\Calendar;
use App\Entity\FeastDay;
use App\Feastday\Domain\FeastdayDeleterRepository;
use App\Feastday\Domain\FeastdayRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;

final class OrmCalendarCrudRepository implements CalendarUpdaterRepository, FeastdayRepository, FeastdayDeleterRepository
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getCalendarByCalendarId(string $calendarId): ?Calendar
    {
        $calendarRepository = $this->entityManager->getRepository(Calendar::class);
        $calendarEntity = $calendarRepository->find($calendarId);

        return $calendarEntity;
    }

    public function saveCalendar(Calendar $calendarEntity): void
    {
        $this->entityManager->persist($calendarEntity);
        $this->entityManager->flush();
    }

    public function findFeastday(string $calendarId, DateTimeImmutable $feastdaydate): ?FeastDay
    {
        $feastdayRepository = $this->entityManager->getRepository(Feastday::class);
        $feastday = $feastdayRepository->findBy(
            [
                'calendar' => $calendarId,
                'feastdayDate.feastdayDate' => $feastdaydate
            ]
        );

        $feastdayEntity = [] === $feastday ? null : $feastday[0];

        return $feastdayEntity;
    }

    public function saveFeastday(FeastDay $feastdayEntity): void
    {
        $this->entityManager->persist($feastdayEntity);
        $this->entityManager->flush();
    }

    public function deleteFeastday(FeastDay $feastdayEntity): void
    {
        $this->entityManager->remove($feastdayEntity);
        $this->entityManager->flush();
    }
}
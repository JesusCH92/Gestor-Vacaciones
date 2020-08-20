<?php

declare(strict_types = 1);

namespace App\Calendar\Infrastructure;

use App\Calendar\Domain\CalendarUpdaterRepository;
use App\Entity\Calendar;
use Doctrine\ORM\EntityManagerInterface;

final class OrmCalendarCrudRepository implements CalendarUpdaterRepository
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
}
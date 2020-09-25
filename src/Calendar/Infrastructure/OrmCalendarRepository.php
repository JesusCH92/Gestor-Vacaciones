<?php

declare(strict_types=1);

namespace App\Calendar\Infrastructure;

use App\Calendar\Domain\CalendarRepository;
use App\Entity\Calendar;
use Doctrine\ORM\EntityManagerInterface;

final class OrmCalendarRepository implements CalendarRepository
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function findCalendarByWorkingYear(int $workingYear): ?Calendar
    {
        $workinYear = intval($workingYear);
        $calendarRepository = $this->entityManager->getRepository(Calendar::class);
        $calendar = $calendarRepository->findBy(
            [
                'workingYear.workingYear' => $workinYear
            ]
        );

        $calendarEntity = [] === $calendar ? null : $calendar[0];

        return $calendarEntity;
    }

    public function saveCalendarConfig(Calendar $calendar, array $typeDayOffCollection, array $feastdayCollection): void
    {
        $this->saveCalendar($calendar);
        $this->saveTypeDayOffCollection($typeDayOffCollection);
        $this->saveFeastdayCollection($feastdayCollection);
    }

    public function saveCalendar(Calendar $calendarEntity): void
    {
        $this->entityManager->persist($calendarEntity);
        $this->entityManager->flush();
    }

    public function saveTypeDayOffCollection(array $typeDayOffCollection): void
    {
        foreach ($typeDayOffCollection as $typeDayOffEntity) {
            $this->entityManager->persist($typeDayOffEntity);
            $this->entityManager->flush();
        }
    }

    public function saveFeastdayCollection(array $feastdayCollection): void
    {
        foreach ($feastdayCollection as $feastdayEntity) {
            $this->entityManager->persist($feastdayEntity);
            $this->entityManager->flush();
        }
    }

}
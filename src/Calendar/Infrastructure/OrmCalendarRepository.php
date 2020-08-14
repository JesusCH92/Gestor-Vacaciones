<?php

declare(strict_types = 1);

namespace App\Calendar\Infrastructure;

use App\Calendar\ApplicationService\DTO\CalendarRequest;
use App\Calendar\Domain\CalendarRepository;
use App\Calendar\Domain\ValueObject\WorkDays;
use App\Calendar\Domain\ValueObject\WorkingYear;
use App\Entity\Calendar;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;

final class OrmCalendarRepository implements CalendarRepository
{
    private EntityManagerInterface $entityManager;
    
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function findCalendarByWorkingYear(CalendarRequest $calendarRequest): ?Calendar
    {
        $workinYear = intval($calendarRequest->workingYear());
        $calendarRepository = $this->entityManager->getRepository(Calendar::class);
        $calendar = $calendarRepository->findBy(
            [
                'workingYear.workingYear' => $workinYear
            ]
        );

        $calendarEntity = [] === $calendar ? null : $calendar[0];

        return $calendarEntity;
    }

    public function saveCalendar(CalendarRequest $calendarRequest): void
    {
        $workingYear = new WorkingYear(intval($calendarRequest->workingYear()));
        $workDays = new WorkDays($calendarRequest->workDays());
        $calendarEntity = new Calendar(
            new DateTimeImmutable($calendarRequest->initDateRequest()),
            new DateTimeImmutable($calendarRequest->endDateRequest()),
            $workDays,
            $calendarRequest->workDays(),
            $calendarRequest->company(),
            $workingYear
        );

        $this->entityManager->persist($calendarEntity);
        $this->entityManager->flush();
    }

    public function saveCalendarConfig(CalendarRequest $calendarRequest): void
    {
        $this->saveCalendar($calendarRequest);
    }
}
<?php

declare(strict_types = 1);

namespace App\Calendar\Infrastructure;

use App\Calendar\Domain\CalendarByWorkingYearRepository;
use App\Entity\Calendar;
use App\Entity\Company;
use Doctrine\ORM\EntityManagerInterface;

final class OrmCalendarByWorkingYearRepository implements CalendarByWorkingYearRepository
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getAllCalendarByCompany(Company $company): array
    {
        $calendarRepository = $this->entityManager->getRepository(Calendar::class);
        $calendar = $calendarRepository->findBy(
            [
                'company' => $company
            ]
        );
        
        return $calendar;
    }
}
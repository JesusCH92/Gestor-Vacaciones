<?php

declare(strict_types = 1);

namespace App\TypeDayOff\Infrastructure;

use App\Entity\TypeDayOff;
use App\TypeDayOff\Domain\TypeDayOffRepository;
use Doctrine\ORM\EntityManagerInterface;

final class OrmTypeDayOffRepository implements TypeDayOffRepository
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getTypeDayOff(string $calendarId, string $dayoffType): ?TypeDayOff
    {
        $typeDayOffRepository = $this->entityManager->getRepository(TypeDayOff::class);
        $typeDayOff = $typeDayOffRepository->findBy(
            [
                'calendar'   => $calendarId,
                'typeDayOff' => $dayoffType
            ]
        );

        $typeDayOffEntity = [] === $typeDayOff ? null : $typeDayOff[0];

        return $typeDayOffEntity;
    }

    public function saveTypeDayOff(TypeDayOff $typeDayOff): void
    {
        $this->entityManager->persist($typeDayOff);
        $this->entityManager->flush();
    }
}
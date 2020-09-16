<?php

declare(strict_types=1);

namespace App\DayOffForm\Infrastructure;

use App\DayOffForm\Domain\DayOffFormByUserRepository;
use App\DayOffForm\Domain\DayOffFormDeleteRepository;
use App\Entity\DayOffForm;
use App\Entity\DayOffFormRequest;
use App\User\Domain\User;
use Doctrine\ORM\EntityManagerInterface;

final class OrmDayOffFormByUserRepository implements DayOffFormByUserRepository, DayOffFormDeleteRepository
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function findDayOffFormWithDatesByUser(User $user)
    {
        $qb = $this
            ->entityManager
            ->createQueryBuilder()
            ->select('dof', 'dofr')
            ->from(DayOffForm::class, 'dof')
            ->leftJoin(DayOffFormRequest::class, 'dofr', 'WITH', 'dof.codeDayOffForm = dofr.dayOffForm')
            ->where('dof.user = :userId')
            ->setParameter('userId', $user->userId());

        return $qb->getQuery()->getResult();
    }

    public function deleteDayOffForm(DayOffForm $dayOffForm): void
    {
        $this->entityManager->remove($dayOffForm);
        $this->entityManager->flush();
    }

    public function deleteDayOffFormRequest(DayOffFormRequest $dayOffFormRequest): void
    {
        $this->entityManager->remove($dayOffFormRequest);
        $this->entityManager->flush();
    }
}
<?php

declare(strict_types=1);

namespace App\DayOffForm\Infrastructure;

use App\DayOffForm\Domain\DayOffRepository;
use App\DayOffForm\Domain\ValueObject\StatusDayOffForm;
use App\Entity\Calendar;
use App\Entity\DayOffForm;
use App\User\Domain\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\Expr\Join;

final class DoctrineDayOffRepository implements DayOffRepository
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function findByUserAndStatusDayOffForm(User $user, Calendar $calendar, string $typeDayOffForm): array
    {
        $query = $this
            ->entityManager
            ->createQuery(
                <<<DQL
SELECT d.countDayOffRequest.countDayOffRequest
FROM App\Entity\DayOffForm d
WHERE d.user = :user AND d.calendar = :calendar AND d.typeDayOff = :type AND (d.statusDayOffForm.statusDayOffForm = :approved OR d.statusDayOffForm.statusDayOffForm = :pending )
DQL
            )->setParameters(
                [
                    'user' => $user,
                    'calendar' => $calendar,
                    'type' => $typeDayOffForm,
                    'approved' => StatusDayOffForm::APPROVED,
                    'pending' => StatusDayOffForm::PENDING
                ]
            );

        return $query->getResult();
    }

    public function saveDayOffForm(DayOffForm $dayOffForm, array $dayOffFormRequestCollection): void
    {
        $this->entityManager->persist($dayOffForm);
        $this->entityManager->flush();

        $this->saveDayOffFormRequest($dayOffFormRequestCollection);
    }

    public function saveDayOffFormRequest(array $dayOffFormRequestCollection): void
    {
        foreach ($dayOffFormRequestCollection as $dayOffFormRequest) {
            $this->entityManager->persist($dayOffFormRequest);
            $this->entityManager->flush();
        }
    }

    public function approveDayOffForm(string $dayOffFormId, string $observation, string $supervisorId)
    {
        $query = $this
            ->entityManager
            ->createQuery(
                <<<DQL
UPDATE App\Entity\DayOffForm d
SET d.statusDayOffForm.statusDayOffForm = :status, d.observation = :observation, d.supervisorId = :supervisor
WHERE d.codeDayOffForm = :code
DQL
            )->setParameters(
                [
                    'status' => StatusDayOffForm::APPROVED,
                    'observation' => $observation,
                    'supervisor' => $supervisorId,
                    'code' => $dayOffFormId
                ]
            );

        $query->execute();
    }

    public function denyDayOffForm(string $dayOffFormId, string $observation, string $supervisorId)
    {
        $query = $this
            ->entityManager
            ->createQuery(
                <<<DQL
UPDATE App\Entity\DayOffForm d
SET d.statusDayOffForm.statusDayOffForm = :status, d.observation = :observation, d.supervisorId = :supervisor
WHERE d.codeDayOffForm = :code
DQL
            )->setParameters(
                [
                    'status' => StatusDayOffForm::DENIED,
                    'observation' => $observation,
                    'supervisor' => $supervisorId,
                    'code' => $dayOffFormId
                ]
            );

        $query->execute();
    }

    public function findByCalendarByUser(Calendar $calendar, string $userId): array
    {
        $qb = $this->entityManager->createQueryBuilder();

        $qb
            ->select('dof.typeDayOff', 'dof.statusDayOffForm.statusDayOffForm', 'dor.dayOffSelected.dayOffSelected')
            ->from('App\Entity\DayOffForm', 'dof')
            ->leftJoin('App\Entity\DayOffFormRequest',
                'dor',
                Join::WITH,
                'dof = dor.dayOffForm'
            )
            ->where('
            dof.user = :userId 
            and dof.calendar = :calendar ')
            ->setParameter('calendar', $calendar)
            ->setParameter('userId', $userId);

        return $qb->getQuery()->getResult();
    }

    public function findUsersInDayOffToday(): array
    {
        $qb = $this->entityManager->createQueryBuilder();

        $qb
            ->select('u.email', 'u.name', 'u.lastname', 'dof.typeDayOff',
                'dor.dayOffSelected.dayOffSelected')
            ->from('App\User\Infrastructure\Model\SymfonyUser', 'u')
            ->leftJoin(
                'App\Entity\DayOffForm',
                'dof',
                Join::WITH,
                'u.userId = dof.user'
            )
            ->leftJoin('App\Entity\DayOffFormRequest',
                'dor',
                Join::WITH,
                'dof = dor.dayOffForm'
            )
            ->where('dof.statusDayOffForm.statusDayOffForm = :statusDayOffForm
            and dor.dayOffSelected.dayOffSelected = :dayOffSelected')
            ->setParameter('statusDayOffForm', StatusDayOffForm::APPROVED)
            ->setParameter('dayOffSelected', Date('Y-m-d'));
        return $qb->getQuery()->getResult();
    }

    public function findLastDayOffFormRequestByUser(User $user)
    {
        $qb = $this->entityManager->createQueryBuilder();

        $qb
            ->select('dof.statusDayOffForm.statusDayOffForm')
            ->from('App\Entity\DayOffForm', 'dof')
            ->where('dof.user = :userId')
            ->orderBy('dof.createdAt', 'DESC')
            ->setMaxResults(1)
            ->setParameter('userId', $user->userId());

        return $qb->getQuery()->getResult();
    }
}
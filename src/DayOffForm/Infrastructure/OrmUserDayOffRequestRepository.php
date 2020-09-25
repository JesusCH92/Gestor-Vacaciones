<?php

declare(strict_types=1);

namespace App\DayOffForm\Infrastructure;

use App\DayOffForm\Domain\DTO\DatesDayOffFormRequest;
use App\DayOffForm\Domain\UserDayOffRequestRepository;
use App\Entity\DayOffForm;
use App\Entity\DayOffFormRequest;
use App\Entity\Department;
use App\User\Infrastructure\Model\SymfonyUser;
use Doctrine\ORM\EntityManagerInterface;

final class OrmUserDayOffRequestRepository implements UserDayOffRequestRepository
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function findUsersByDepartmentByPendingStatus(Department $department): array
    {
        $usersByDepartmentCollection = $this->findUsersByDepartment($department);
        return $this->findUsersWithPendingStatusOfDayOffForm($usersByDepartmentCollection);
    }

    public function findUsersByDepartment(Department $department)
    {
        $userRepository = $this->entityManager->getRepository(SymfonyUser::class);
        return $userRepository->findBy(['department' => $department]);
    }

    public function findUsersWithPendingStatusOfDayOffForm(array $usersCollection): array
    {
        $usersByPendingStatusCollection = [];
        $dayOffFormRepository = $this->entityManager->getRepository(DayOffForm::class);
        foreach ($usersCollection as $user) {

            $dayOffFormCollection = $dayOffFormRepository->findBy([
                'user' => $user,
                'statusDayOffForm.statusDayOffForm' => 'Pending'
            ],
                ['createdAt' => 'ASC']);

            foreach ($dayOffFormCollection as $dayOffForm) {
                $userByPendingStatus = ['user' => $user, 'day_off_form' => $dayOffForm];
                array_push($usersByPendingStatusCollection, $userByPendingStatus);
            }

        }
        return $usersByPendingStatusCollection;
    }

    public function findDayOfFormById(string $dayOffFormId): ?DayOffForm
    {
        $userRepository = $this->entityManager->getRepository(DayOffForm::class);
        return $userRepository->find($dayOffFormId);

    }

    public function findByDayOffFormRequestById(DatesDayOffFormRequest $dayOffForm): array
    {
        $userRepository = $this->entityManager->getRepository(DayOffFormRequest::class);
        return $userRepository->findBy(['dayOffForm' => $dayOffForm->dayOffForm()]);
    }
}
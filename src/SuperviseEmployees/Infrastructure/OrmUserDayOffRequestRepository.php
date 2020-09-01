<?php


namespace App\SuperviseEmployees\Infrastructure;


use App\Entity\DayOffForm;
use App\Entity\DayOffFormRequest;
use App\Entity\Department;
use App\SuperviseEmployees\Domain\DTO\DatesDayOffFormRequest;
use App\SuperviseEmployees\Domain\UserDayOffRequestRepository;
use App\User\Infrastructure\Model\SymfonyUser;
use Doctrine\ORM\EntityManagerInterface;

final class OrmUserDayOffRequestRepository implements UserDayOffRequestRepository
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
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

            $dayOffFormCollection = $dayOffFormRepository->findBy(['user' => $user, 'statusDayOffForm.statusDayOffForm' => 'Pending']);

            foreach ($dayOffFormCollection as $dayOffForm) {
                $userByPendingStatus = ['user' => $user, 'day_off_form' => $dayOffForm];
                array_push($usersByPendingStatusCollection, $userByPendingStatus);
            }

        }
        return $usersByPendingStatusCollection;
    }

    public function findUsersByDepartmentByPendingStatus(Department $department)
    {
        $usersByDepartmentCollection = $this->findUsersByDepartment($department);
        return $this->findUsersWithPendingStatusOfDayOffForm($usersByDepartmentCollection);
    }

    public function findDayOfFormById(string $dayOffFormId)
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
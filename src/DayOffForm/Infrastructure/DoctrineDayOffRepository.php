<?php


namespace App\DayOffForm\Infrastructure;


use App\DayOffForm\Domain\DayOffRepository;
use App\Entity\DayOffForm;
use App\Entity\DayOffFormRequest;
use App\User\Domain\User;
use Doctrine\ORM\EntityManagerInterface;

final class DoctrineDayOffRepository implements DayOffRepository
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function findOne(User $user)
    {
        $dayOffRepository = $this->entityManager->getRepository(DayOffForm::class);
        return $dayOffRepository->findBy(['idUser' => $user]);
    }

    public function findByUserAndStatusDayOffForm(User $user, string $typeDayOffForm): array
    {
        $query = $this
            ->entityManager
            ->createQuery(
                <<<DQL
SELECT d.countDayOffRequest.countDayOffRequest
FROM App\Entity\DayOffForm d
WHERE d.user = :user AND d.typeDayOff = :type AND (d.statusDayOffForm.statusDayOffForm = :approved OR d.statusDayOffForm.statusDayOffForm = :pending )
DQL
            )->setParameters(
                [
                    'user' => $user,
                    'type' => $typeDayOffForm,
                    'approved' => 'APPROVED',
                    'pending' => 'PENDING'
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

    public function saveDayOffFormRequest(array $dayOffFormRequestCollection) :void
    {
        foreach ($dayOffFormRequestCollection as $dayOffFormRequest) {
            $this->entityManager->persist($dayOffFormRequest);
            $this->entityManager->flush();
        }
    }
}
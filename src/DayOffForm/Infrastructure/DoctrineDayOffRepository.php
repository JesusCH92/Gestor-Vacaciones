<?php


namespace App\DayOffForm\Infrastructure;


use App\DayOff\Domain\DayOffRepository;
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

    public function saveDayOffForm(DayOffForm $dayOffForm)
    {
        $this->entityManager->persist($dayOffForm);
        $this->entityManager->flush();
    }

    public function saveDayOffFormRequest(DayOffFormRequest $dayOffFormRequest)
    {
        $this->entityManager->persist($dayOffFormRequest);
        $this->entityManager->flush();
    }
}
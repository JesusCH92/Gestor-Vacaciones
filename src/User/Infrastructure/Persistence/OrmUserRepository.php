<?php

declare(strict_types = 1);

namespace App\User\Infrastructure\Persistence;

use App\User\Domain\User;
use App\User\Domain\UserRepository;
use App\User\Infrastructure\Model\SymfonyUser;
use Doctrine\ORM\EntityManagerInterface;

final class OrmUserRepository implements UserRepository
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function findUserByEmail(string $email): ?User

    {
        $userRepository = $this->entityManager->getRepository(SymfonyUser::class);
        $user = $userRepository->findBy(
            [
                'email' => $email
            ]
        );

        $userEntity = [] === $user ? null : $user[0];
        return $userEntity;
    }

    public function saveUser(User $user): void
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}
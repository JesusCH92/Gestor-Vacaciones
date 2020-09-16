<?php

declare(strict_types = 1);

namespace App\User\Infrastructure\Persistence;

use App\Common\Infrastructure\Constants\Constants;
use App\User\Domain\User;
use App\User\Domain\UserByDepartmentRepository;
use App\User\Domain\UserByIdRepository;
use App\User\Domain\UserDeleteRepository;
use App\User\Domain\UserRepository;
use App\User\Infrastructure\Model\SymfonyUser;
use Doctrine\ORM\EntityManagerInterface;

final class OrmUserRepository implements UserRepository, UserByDepartmentRepository, UserByIdRepository, UserDeleteRepository
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

    public function findUsersByDepartment(string $userName, string $departmentId): array
    {
        $qb = $this
            ->entityManager
            ->createQueryBuilder()
            ->select('su')
            ->from(SymfonyUser::class, 'su')
            ->where('su.department = :department')
            ->andWhere('su.name LIKE :username')
            ->andWhere('su.userId <> :adminId')
            ->setParameter('department', $departmentId)
            ->setParameter('username', "%$userName%")
            ->setParameter('adminId', Constants::ADMIN_ID)
            ;
            
        return $qb->getQuery()->getResult();
    }

    public function findUserById(string $userId): ?User
    {
        $userRepository = $this->entityManager->getRepository(SymfonyUser::class);
        $user = $userRepository->find($userId); // ! return entity or null

        return $user;
    }

    public function deleteUser(User $user): void
    {
        $this->entityManager->remove($user);
        $this->entityManager->flush();
    }
}
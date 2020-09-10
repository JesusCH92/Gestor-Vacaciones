<?php

declare(strict_types = 1);

namespace App\User\ApplicationService;

use App\User\ApplicationService\DTO\UserByIdRequest;
use App\User\ApplicationService\DTO\UserRoleRequest;
use App\User\ApplicationService\Exception\UserNotFoundException;
use App\User\Domain\UserRepository;
use Ramsey\Uuid\Nonstandard\Uuid;

final class UserRoleEditor
{
    private FindUserById $findUserById;
    private UserRepository $userRepository;

    public function __construct(FindUserById $findUserById, UserRepository $userRepository)
    {
        $this->findUserById = $findUserById;
        $this->userRepository = $userRepository;
    }

    public function __invoke(UserRoleRequest $userRoleRequest)
    {
        $userId = $userRoleRequest->userId();
        $userByIdRequest = new UserByIdRequest($userId);
        $userEntity = $this->findUserById->__invoke($userByIdRequest);

        if (null === $userEntity) {
            throw new UserNotFoundException($userId);
        }

        $userEntity->roles()->setRole($userRoleRequest->role());

        $this->userRepository->saveUser($userEntity);   // ! update and save it's idem in doctrine
    }
}
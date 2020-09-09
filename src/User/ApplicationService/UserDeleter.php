<?php

declare(strict_types = 1);

namespace App\User\ApplicationService;

use App\User\ApplicationService\DTO\UserByIdRequest;
use App\User\ApplicationService\Exception\UserNotFoundException;
use App\User\Domain\UserDeleteRepository;

final class UserDeleter
{
    private FindUserById $findUserById;
    private UserDeleteRepository $userDeleteRepository;

    public function __construct(FindUserById $findUserById, UserDeleteRepository $userDeleteRepository)
    {
        $this->findUserById = $findUserById;
        $this->userDeleteRepository = $userDeleteRepository;
    }

    public function __invoke(UserByIdRequest $userByIdRequest)
    {
        $userEntity = $this->findUserById->__invoke($userByIdRequest);

        if (null === $userEntity) {
            throw new UserNotFoundException($userByIdRequest->userId());
        }

        $this->userDeleteRepository->deleteUser($userEntity);
    }
}
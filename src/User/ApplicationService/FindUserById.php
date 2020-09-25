<?php

declare(strict_types=1);

namespace App\User\ApplicationService;

use App\User\ApplicationService\DTO\UserByIdRequest;
use App\User\ApplicationService\Exception\UserNotFoundException;
use App\User\Domain\UserByIdRepository;
use Ramsey\Uuid\Nonstandard\Uuid;

final class FindUserById
{
    private UserByIdRepository $userByIdRepository;

    public function __construct(UserByIdRepository $userByIdRepository)
    {
        $this->userByIdRepository = $userByIdRepository;
    }

    public function __invoke(UserByIdRequest $userByIdRequest)
    {
        $userId = $userByIdRequest->userId();

        if (!Uuid::isValid($userId)) {
            throw new UserNotFoundException($userId);
        }

        return $this->userByIdRepository->findUserById($userId);
    }
}
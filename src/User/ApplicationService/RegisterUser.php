<?php

declare(strict_types = 1);

namespace App\User\ApplicationService;

use App\User\ApplicationService\DTO\RegisterUserRequest;
use App\User\ApplicationService\Exception\AlreadyExistingUserException;
use App\User\Domain\Factory\UserFactory;
use App\User\Domain\UserRepository;
use App\User\Domain\ValueObject\Roles;

final class RegisterUser
{
    private UserFactory $userFactory;

    private UserRepository $userRepository;

    public function __construct(UserFactory $userFactory, UserRepository $userRepository)
    {
        $this->userFactory = $userFactory;
        $this->userRepository = $userRepository;
    }

    public function __invoke(RegisterUserRequest $registerUserRequest)
    {
        $email = $registerUserRequest->email();

        if (null !== $this->userRepository->findUserByEmail($email)) {
            throw new AlreadyExistingUserException($email);
        }

        $roles = new Roles($registerUserRequest->roles());

        $user = $this->userFactory->register(
            $registerUserRequest->name(),
            $registerUserRequest->lastName(),
            $registerUserRequest->phone(),
            $email,
            $registerUserRequest->password(),
            $registerUserRequest->deparment(),
            $registerUserRequest->company(),
            $roles
        );

        $this->userRepository->saveUser($user);
    }
}
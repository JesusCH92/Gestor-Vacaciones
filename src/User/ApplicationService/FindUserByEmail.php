<?php

declare(strict_types=1);

namespace App\User\ApplicationService;

use App\User\Domain\UserRepository;

final class FindUserByEmail
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(string $email)
    {
        return $this->userRepository->findUserByEmail($email);
    }
}
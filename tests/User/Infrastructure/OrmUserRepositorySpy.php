<?php


namespace App\Tests\User\Infrastructure;


use App\User\Domain\User;
use App\User\Domain\UserRepository;

class OrmUserRepositorySpy implements UserRepository
{
    private $validateWasCalled = false;

    public function findUserByEmail(string $email): ?User
    {
        return null;
    }

    public function saveUser(User $user): void
    {
        $this->validateWasCalled = true;
    }

    public function verify(): bool
    {
        return $this->validateWasCalled;
    }
}
<?php


namespace App\Tests\User\Infrastructure;


use App\User\Domain\User;
use App\User\Domain\UserRepository;

class OrmUserRepositoryStub implements UserRepository
{

    public function findUserByEmail(string $email): ?User
    {
        return null;
    }

    public function saveUser(User $user): void
    {
        // TODO: Implement saveUser() method.
    }
}
<?php


namespace App\Tests\User\Infrastructure;


use App\Entity\Company;
use App\Entity\Department;
use App\User\Domain\User;
use App\User\Domain\UserRepository;
use App\User\Domain\ValueObject\Roles;

class OrmUserRepositoryInvalidStub implements UserRepository
{

    public function findUserByEmail(string $email): ?User
    {
        $company = new Company();
        return new User('miriam@gmail.com', 'miriam', 'lopez', '663768798', new Roles('ROLE_SUPERVISOR'),
            'miriam', new Department('TFM', 't', $company), $company);
    }

    public function saveUser(User $user): void
    {
    }
}
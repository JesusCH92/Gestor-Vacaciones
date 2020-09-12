<?php


namespace App\Tests\User\Infrastructure;


use App\Entity\Company;
use App\Entity\Department;
use App\User\Domain\Factory\UserFactory;
use App\User\Domain\User;
use App\User\Domain\ValueObject\Roles;
use App\User\Infrastructure\Model\SymfonyUser;

class OrmUserFactoryDummy implements UserFactory
{

    public function register(
        string $name,
        string $lastName,
        string $phone,
        string $email,
        string $password,
        Department $deparment,
        Company $company,
        Roles $roles
    ): User {
        return new SymfonyUser($email, $name, $lastName, $phone, $roles, $password, $deparment, $company);
    }
}
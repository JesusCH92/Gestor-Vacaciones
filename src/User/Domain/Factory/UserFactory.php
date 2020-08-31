<?php

declare(strict_types = 1);

namespace App\User\Domain\Factory;

use App\Entity\Company;
use App\Entity\Department;
use App\User\Domain\User;
use App\User\Domain\ValueObject\Roles;

interface UserFactory
{
    public function register(string $name, string $lastName, string $phone, string $email, string $password, Department $deparment, Company $company, Roles $roles): User;
}
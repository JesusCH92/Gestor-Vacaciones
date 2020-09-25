<?php

declare(strict_types=1);

namespace App\User\ApplicationService\DTO;

use App\Entity\Company;
use App\Entity\Department;

final class RegisterUserRequest
{
    private string $name;
    private string $lastName;
    private string $phone;
    private string $email;
    private string $password;
    private Department $deparment;
    private Company $company;
    private string $roles;

    public function __construct(
        string $name,
        string $lastName,
        string $phone,
        string $email,
        string $password,
        Department $deparment,
        Company $company,
        string $roles
    ) {
        $this->name = $name;
        $this->lastName = $lastName;
        $this->phone = $phone;
        $this->email = $email;
        $this->password = $password;
        $this->deparment = $deparment;
        $this->company = $company;
        $this->roles = $roles;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function lastName(): string
    {
        return $this->lastName;
    }

    public function phone(): string
    {
        return $this->phone;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function password(): string
    {
        return $this->password;
    }

    public function deparment(): Department
    {
        return $this->deparment;
    }

    public function company(): Company
    {
        return $this->company;
    }

    public function roles(): string
    {
        return $this->roles;
    }
}
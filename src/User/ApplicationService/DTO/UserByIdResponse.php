<?php

declare(strict_types = 1);

namespace App\User\ApplicationService\DTO;

final class UserByIdResponse
{
    private string $userName;
    private string $userLastName;
    private string $userEmail;
    private string $userPhone;
    private string $company;
    private string $department;
    private string $userRole;

    public function __construct(string $userName, string $userLastName, string $userEmail, string $userPhone, string $company, string $department, string $userRole)
    {
        $this->userName = $userName;
        $this->userLastName = $userLastName;
        $this->userEmail = $userEmail;
        $this->userPhone = $userPhone;
        $this->company = $company;
        $this->department = $department;
        $this->userRole = $userRole;
    }

    public function userName() : string
    {
        return $this->userName;
    }

    public function userLastName() : string
    {
        return $this->userLastName;
    }

    public function userEmail() : string
    {
        return $this->userEmail;
    }
    
    public function userPhone() : string
    {
        return $this->userPhone;
    }

    public function company() : string
    {
        return $this->company;
    }

    public function department() : string
    {
        return $this->department;
    }

    public function userRole() : string
    {
        return $this->userRole;
    }
}
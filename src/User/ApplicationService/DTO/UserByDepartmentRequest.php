<?php

declare(strict_types = 1);

namespace App\User\ApplicationService\DTO;

final class UserByDepartmentRequest
{
    private string $userName;
    private string $department;

    public function __construct(string $userName, string $department)
    {
        $this->userName = $userName;
        $this->department = $department;
    }

    public function userName()
    {
        return $this->userName;
    }

    public function department()
    {
        return $this->department;
    }
}
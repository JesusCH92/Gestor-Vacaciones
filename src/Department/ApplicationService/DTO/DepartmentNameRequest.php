<?php

declare(strict_types = 1);

namespace App\Department\ApplicationService\DTO;

final class DepartmentNameRequest
{
    private string $departmentId;
    private string $departmentName;

    public function __construct(string $departmentId, string $departmentName)
    {
        $this->departmentId = $departmentId;
        $this->departmentName = $departmentName;
    }

    public function departmentId(): string
    {
        return $this->departmentId;
    }

    public function departmentName(): string
    {
        return $this->departmentName;
    }
}
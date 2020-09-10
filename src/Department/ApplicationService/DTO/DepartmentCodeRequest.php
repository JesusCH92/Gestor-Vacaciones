<?php

declare(strict_types = 1);

namespace App\Department\ApplicationService\DTO;

final class DepartmentCodeRequest
{
    private string $departmentId;
    private string $departmentCode;

    public function __construct(string $departmentId, string $departmentCode)
    {
        $this->departmentId = $departmentId;
        $this->departmentCode = $departmentCode;
    }

    public function departmentId(): string
    {
        return $this->departmentId;
    }

    public function departmentCode(): string
    {
        return $this->departmentCode;
    }
}
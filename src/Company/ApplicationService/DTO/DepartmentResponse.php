<?php

namespace App\Company\ApplicationService\DTO;

final class DepartmentResponse
{
    private int $departmentId;

    private string $departmentName;

    private string $departmentCode;

    public function __construct(int $departmentId, string $departmentName, string $departmentCode)
    {
        $this->departmentId = $departmentId;
        $this->departmentName = $departmentName;
        $this->departmentCode = $departmentCode;
    }

    public function departmentId() : int
    {
        return $this->departmentId;
    }

    public function departmentName() : string
    {
        return $this->departmentName;
    }

    public function departmentCode() : string
    {
        return $this->departmentCode;
    }
    
}
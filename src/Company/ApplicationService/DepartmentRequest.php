<?php

namespace App\Company\ApplicationService;

final class DepartmentRequest
{
    private int $companyId;

    private string $departmentName;

    private string $departmentCode;

    public function __construct(int $companyId, string $departmentName, string $departmentCode)
    {
        $this->companyId = $companyId;
        $this->departmentName = $departmentName;
        $this->departmentCode = $departmentCode;
    }

    public function companyId() : int
    {
        return $this->companyId;
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
<?php


namespace App\Department\ApplicationService\DTO;


final class DepartmentByNameRequest
{
    private string $departmentName;

    public function __construct(string $departmentName)
    {
        $this->departmentName = $departmentName;
    }

    public function departmentName(): string
    {
        return $this->departmentName;
    }
}
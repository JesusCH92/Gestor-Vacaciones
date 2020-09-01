<?php


namespace App\Department\ApplicationService\DTO;


use App\Entity\Department;

final class DepartmentByNameResponse
{
    private Department $department;

    public function __construct(Department $department)
    {
        $this->department = $department;
    }

    public function department(): Department
    {
        return $this->department;
    }
}
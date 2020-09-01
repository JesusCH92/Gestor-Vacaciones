<?php


namespace App\User\ApplicationService\DTO;

use App\Entity\Department;

final class DepartmentRequest
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
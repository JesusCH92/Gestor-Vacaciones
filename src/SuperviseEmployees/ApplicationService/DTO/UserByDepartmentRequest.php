<?php


namespace App\SuperviseEmployees\ApplicationService\DTO;


use App\Entity\Department;

final class UserByDepartmentRequest
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
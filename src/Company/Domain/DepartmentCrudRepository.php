<?php

namespace App\Company\Domain;

use App\Company\ApplicationService\DTO\DepartmentRequest;

interface DepartmentCrudRepository
{
    public function checkIfDepartmentCodeExist(string $codeDepartment);
    public function createDepartment(DepartmentRequest $departmentRequest);
}
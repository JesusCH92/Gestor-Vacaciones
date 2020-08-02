<?php

namespace App\Company\Domain;

use App\Company\ApplicationService\DepartmentRequest;

interface DepartmentCrudRepository
{
    public function checkIfDepartmentCodeExist(string $codeDepartment);
    public function createDepartment(DepartmentRequest $departmentRequest);
}
<?php

namespace App\Company\Domain;

Interface DepartmentRepository
{
    public function departmentsByAdmin(int $companyId);
}
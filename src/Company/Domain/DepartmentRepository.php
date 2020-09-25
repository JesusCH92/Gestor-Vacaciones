<?php

declare(strict_types=1);

namespace App\Company\Domain;

interface DepartmentRepository
{
    public function departmentsByAdmin(int $companyId);
}
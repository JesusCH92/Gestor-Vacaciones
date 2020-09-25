<?php

declare(strict_types=1);

namespace App\Department\Domain;

use App\Entity\Department;

interface DepartmentUpdateRepository
{
    public function findDepartmentById(string $departmentId): ?Department;

    public function departmentNameUpdate(string $departmentName, string $departmentId): void;

    public function departmentCodeUpdate(string $departmentCode, string $departmentId): void;
}
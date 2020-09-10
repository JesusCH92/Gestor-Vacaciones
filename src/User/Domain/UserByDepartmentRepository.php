<?php

declare(strict_types = 1);

namespace App\User\Domain;

interface UserByDepartmentRepository
{
    public function findUsersByDepartment(string $userName, string $departmentId): array;
}
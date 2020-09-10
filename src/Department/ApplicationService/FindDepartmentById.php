<?php

declare(strict_types = 1);

namespace App\Department\ApplicationService;

use App\Department\Domain\DepartmentUpdateRepository;

final class FindDepartmentById
{
    private DepartmentUpdateRepository $departmentUpdateRepository;

    public function __construct(DepartmentUpdateRepository $departmentUpdateRepository)
    {
        $this->departmentUpdateRepository = $departmentUpdateRepository;
    }

    public function __invoke(string $departmentId)
    {
        return $this->departmentUpdateRepository->findDepartmentById( $departmentId );
    }
}
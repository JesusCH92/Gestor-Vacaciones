<?php

namespace App\Company\ApplicationService;

use App\Company\Domain\DepartmentCrudRepository;
use App\Company\ApplicationService\DTO\DepartmentRequest;

final class CreateDepartment
{
    private DepartmentCrudRepository $departmentCrudRepository;

    public function __construct(DepartmentCrudRepository $departmentCrudRepository)
    {
        $this->departmentCrudRepository = $departmentCrudRepository;
    }

    public function __invoke(DepartmentRequest $departmentResquest)
    {
        $this->departmentCrudRepository->createDepartment($departmentResquest);
    }
}
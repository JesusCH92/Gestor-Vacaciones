<?php

declare(strict_types=1);

namespace App\Company\ApplicationService;

use App\Company\ApplicationService\DTO\DepartmentRequest;
use App\Company\ApplicationService\DTO\DepartmentResponse;
use App\Company\Domain\DepartmentCrudRepository;

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

        $departmentEntity = $this->departmentCrudRepository->checkIfDepartmentCodeExist(
            $departmentResquest->departmentName(),
            $departmentResquest->departmentCode()
        );

        $departmentResponse = new DepartmentResponse(
            $departmentEntity->departmentId(),
            $departmentEntity->departmentName(),
            $departmentEntity->departmentCode()
        );

        return $departmentResponse;
    }
}
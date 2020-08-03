<?php

namespace App\Company\ApplicationService;

use App\Company\Domain\DepartmentCrudRepository;
use App\Company\ApplicationService\DTO\DepartmentRequest;
use App\Company\ApplicationService\DTO\DepartmentResponse;

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
            $departmentEntity->getId(),
            $departmentEntity->getDepartmentname(),
            $departmentEntity->getDepartmentcode()
        );

        return $departmentResponse;
    }
}
<?php

declare(strict_types = 1);

namespace App\Department\ApplicationService;

use App\Department\ApplicationService\DTO\DepartmentNameRequest;
use App\Department\ApplicationService\Exception\DepartmentNotFoundException;
use App\Department\Domain\DepartmentUpdateRepository;

final class DepartmentNameUpdater
{
    private FindDepartmentById $findDepartmentById;
    private DepartmentUpdateRepository $departmentUpdateRepository;

    public function __construct(FindDepartmentById $findDepartmentById, DepartmentUpdateRepository $departmentUpdateRepository)
    {
        $this->findDepartmentById = $findDepartmentById;
        $this->departmentUpdateRepository = $departmentUpdateRepository;
    }

    public function __invoke(DepartmentNameRequest $departmentNameRequest)
    {
        $departmentEntity = $this->findDepartmentById->__invoke($departmentNameRequest->departmentId());

        if (null === $departmentEntity) {
            throw new DepartmentNotFoundException($departmentNameRequest->departmentId());
        }

        $this->departmentUpdateRepository->departmentNameUpdate(
            $departmentNameRequest->departmentName(),
            $departmentNameRequest->departmentId()
        );

    }
}
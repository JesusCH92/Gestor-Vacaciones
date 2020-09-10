<?php

declare(strict_types = 1);

namespace App\Department\ApplicationService;

use App\Department\ApplicationService\DTO\DepartmentCodeRequest;
use App\Department\ApplicationService\Exception\DepartmentNotFoundException;
use App\Department\Domain\DepartmentUpdateRepository;

final class DepartmentCodeUpdater
{
    private FindDepartmentById $findDepartmentById;
    private DepartmentUpdateRepository $departmentUpdateRepository;

    public function __construct(FindDepartmentById $findDepartmentById, DepartmentUpdateRepository $departmentUpdateRepository)
    {
        $this->findDepartmentById = $findDepartmentById;
        $this->departmentUpdateRepository = $departmentUpdateRepository;
    }

    public function __invoke(DepartmentCodeRequest $departmentCodeRequest)
    {
        $departmentEntity = $this->findDepartmentById->__invoke($departmentCodeRequest->departmentId());

        if (null === $departmentEntity) {
            throw new DepartmentNotFoundException($departmentCodeRequest->departmentId());
        }

        $this->departmentUpdateRepository->departmentCodeUpdate(
            $departmentCodeRequest->departmentCode(),
            $departmentCodeRequest->departmentId()
        );
    }
}
<?php


namespace App\Department\ApplicationService;


use App\Department\ApplicationService\DTO\DepartmentByNameRequest;
use App\Department\ApplicationService\DTO\DepartmentByNameResponse;
use App\Department\Domain\DepartmentRepository;

final class GetDepartmentByName
{
    private DepartmentRepository $departmentRepository;

    public function __construct(DepartmentRepository $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }

    public function __invoke(DepartmentByNameRequest $departmentByNameRequest): DepartmentByNameResponse
    {
        $department = $this->departmentRepository->getDepartmentByName($departmentByNameRequest->departmentName());

        return new DepartmentByNameResponse($department);
    }
}
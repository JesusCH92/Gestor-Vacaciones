<?php


namespace App\Department\ApplicationService;


use App\Department\ApplicationService\DTO\DepartmentCollectionResponse;
use App\Department\Domain\DepartmentRepository;

final class GetAllDepartments
{
    private DepartmentRepository $departmentRepository;

    public function __construct(DepartmentRepository $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }

    public function __invoke(): DepartmentCollectionResponse
    {
        $departmentCollection = $this->departmentRepository->getAllDepartment();

        return new DepartmentCollectionResponse($departmentCollection);
    }
}
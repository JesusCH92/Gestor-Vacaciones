<?php

namespace App\Company\ApplicationService;

use App\Company\Domain\DepartmentRepository;
use App\User\Domain\User;
use App\Company\ApplicationService\DTO\DepartmentResponse;
use App\Company\ApplicationService\DTO\DepartmentsInCompany;

final class GetAllDepartmentsByAdmin
{
    private DepartmentRepository $departmentRepository;

    public function __construct(DepartmentRepository $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }

    public function __invoke(User $user)
    {
        $companyId = $user->getCompany()->getId();
        $companyName = $user->getCompany()->getCompanyname();

        $departmentInCompany = $this->departmentRepository->departmentsByAdmin($companyId);

        $departmentCollection = $this->getAllDepartmentsFormat($departmentInCompany);

        $departmentsInCompanyCollection = new DepartmentsInCompany(
            $companyId,
            $companyName,
            $departmentCollection
        );

        return $departmentsInCompanyCollection;
    }

    public function getAllDepartmentsFormat(array $departmentsInCompany)
    {
        $departmentInCompanyCollection = [];

        foreach ($departmentsInCompany as $department) {
            array_push($departmentInCompanyCollection, new DepartmentResponse(
                $department->departmentId(),
                $department->departmentName(),
                $department->departmentCode()
            ));
        }

        return $departmentInCompanyCollection;
    }
}
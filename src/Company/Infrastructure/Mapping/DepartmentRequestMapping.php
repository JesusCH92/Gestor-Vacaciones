<?php

namespace App\Company\Infrastructure\Mapping;

use App\Entity\Department;
use App\Entity\Company;
use App\Company\ApplicationService\DTO\DepartmentRequest;
use Doctrine\ORM\EntityManagerInterface;

final class DepartmentRequestMapping
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(DepartmentRequest $departmentRequest)
    {
        $departmentEnity = new Department();
        $companyRepository = $this->entityManager->getRepository(Company:: class);

        $companyById = $companyRepository->findBy(
            [ 'id' => $departmentRequest->companyId() ]
        );

        $departmentEnity->setCompany($companyById[0]);
        $departmentEnity->setDepartmentname($departmentRequest->departmentName());
        $departmentEnity->setDepartmentcode($departmentRequest->departmentCode());

        return $departmentEnity;
    }
}
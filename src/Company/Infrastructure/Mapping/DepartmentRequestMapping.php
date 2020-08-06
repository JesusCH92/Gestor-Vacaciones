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
        $companyRepository = $this->entityManager->getRepository(Company:: class);

        $companyById = $companyRepository->findBy(
            [ 'companyId' => $departmentRequest->companyId() ]
        );
        
        $departmentEnity = new Department(
            $departmentRequest->departmentName(),
            $departmentRequest->departmentCode(),
            $companyById[0]
        );

        return $departmentEnity;
    }
}
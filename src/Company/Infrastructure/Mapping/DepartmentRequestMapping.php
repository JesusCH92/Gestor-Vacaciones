<?php

declare(strict_types=1);

namespace App\Company\Infrastructure\Mapping;

use App\Company\ApplicationService\DTO\DepartmentRequest;
use App\Entity\Company;
use App\Entity\Department;
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
            ['companyId' => $departmentRequest->companyId()]
        );

        $departmentEnity = new Department(
            $departmentRequest->departmentName(),
            $departmentRequest->departmentCode(),
            $companyById[0]
        );

        return $departmentEnity;
    }
}
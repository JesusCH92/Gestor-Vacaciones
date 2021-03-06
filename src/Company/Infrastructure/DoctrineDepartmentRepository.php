<?php

declare(strict_types=1);

namespace App\Company\Infrastructure;

use App\Company\ApplicationService\DTO\DepartmentRequest;
use App\Company\Domain\DepartmentCrudRepository;
use App\Company\Domain\DepartmentRepository;
use App\Company\Infrastructure\Mapping\DepartmentRequestMapping;
use App\Entity\Department;
use Doctrine\ORM\EntityManagerInterface;

final class DoctrineDepartmentRepository implements DepartmentRepository, DepartmentCrudRepository
{
    private EntityManagerInterface $entityManager;

    private DepartmentRequestMapping $departmentRequestMapping;

    public function __construct(
        EntityManagerInterface $entityManager,
        DepartmentRequestMapping $departmentRequestMapping
    ) {
        $this->entityManager = $entityManager;
        $this->departmentRequestMapping = $departmentRequestMapping;
    }

    public function departmentsByAdmin(int $companyId)
    {
        $departmentRepository = $this->entityManager->getRepository(Department::class);
        $departmentByCompanyId = $departmentRepository->findBy(
            ['company' => $companyId]
        );

        return $departmentByCompanyId;
        // TODO: refacto-> obtener solo los campos necesarios.
//         $query = $this
//         ->entityManager
//         ->createQuery(
//             <<<DQL
// SELECT d.id, d.departmentname
// FROM App\Entity\Department d
// WHERE d.id = :id
// DQL
//         )->setParameters(
//             [
//                 'id' => $companyId,
//             ]
//         );

//     return $query->getResult(Query::HYDRATE_ARRAY);
    }

    public function checkIfDepartmentCodeExist(string $departmentName, string $codeDepartment)
    {
        // TODO : departmentEntity debe de ser null o devolver la entidad
        $departmentRepository = $this->entityManager->getRepository(Department::class);
        $departmentEntity = $departmentRepository->findBy(
            [
                'departmentName' => $departmentName,
                'departmentCode' => $codeDepartment
            ]
        );

        return $departmentEntity[0];
    }

    public function createDepartment(DepartmentRequest $departmentRequest)
    {
        $departmentMapping = $this->departmentRequestMapping;
        $departmentEntity = $departmentMapping($departmentRequest);

        $this->entityManager->persist($departmentEntity);
        $this->entityManager->flush();
    }
}
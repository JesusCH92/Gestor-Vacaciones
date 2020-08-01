<?php

namespace App\Company\Infrastructure;

use App\Company\Domain\DepartmentRepository;
use App\Entity\Department;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query;

final class DoctrineDepartmentRepository implements DepartmentRepository
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function departmentsByAdmin(int $companyId)
    {
        $departmentRepository = $this->entityManager->getRepository(Department::class);
        $departmentByCompanyId = $departmentRepository->findBy(
            ['company' => $companyId]
        );

        return $departmentByCompanyId;
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
}
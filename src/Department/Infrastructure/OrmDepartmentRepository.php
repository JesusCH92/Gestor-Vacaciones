<?php


namespace App\Department\Infrastructure;


use App\Department\Domain\DepartmentRepository;
use App\Department\Domain\DepartmentUpdateRepository;
use App\Entity\Department;
use Doctrine\ORM\EntityManagerInterface;

final class OrmDepartmentRepository implements DepartmentRepository, DepartmentUpdateRepository
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getAllDepartment(): array
    {
        $department = $this->entityManager->getRepository(Department::class);
        return $department->findAll();
    }

    public function findDepartmentById(string $departmentId): ?Department
    {
        $department = $this->entityManager->getRepository(Department::class);
        return $department->find($departmentId);
    }

    public function departmentNameUpdate(string $departmentName, string $departmentId): void
    {
        $qb = $this
            ->entityManager
            ->createQueryBuilder()
            ->update(Department::class, 'd')
            ->set('d.departmentName',':departmentName')
            ->where('d.departmentId = :departmentId')
            ->setParameter('departmentName', $departmentName)
            ->setParameter('departmentId', $departmentId)
            ->getQuery()
            ;
        $qb->execute();
    }

    public function departmentCodeUpdate(string $departmentCode, string $departmentId): void
    {
        $qb = $this
            ->entityManager
            ->createQueryBuilder()
            ->update(Department::class, 'd')
            ->set('d.departmentCode',':departmentCode')
            ->where('d.departmentId = :departmentId')
            ->setParameter('departmentCode', $departmentCode)
            ->setParameter('departmentId', $departmentId)
            ->getQuery()
            ;
        $qb->execute();
    }

}
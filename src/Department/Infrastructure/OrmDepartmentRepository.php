<?php


namespace App\Department\Infrastructure;


use App\Department\Domain\DepartmentRepository;
use App\Entity\Department;
use Doctrine\ORM\EntityManagerInterface;

final class OrmDepartmentRepository implements DepartmentRepository
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

}
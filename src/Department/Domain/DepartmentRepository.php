<?php


namespace App\Department\Domain;


interface DepartmentRepository
{
    public function getAllDepartment(): array;
    public function getDepartmentByName(string $name);
}
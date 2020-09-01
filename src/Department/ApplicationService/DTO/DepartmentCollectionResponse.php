<?php


namespace App\Department\ApplicationService\DTO;


final class DepartmentCollectionResponse
{
    private array $departmentCollection;

    public function __construct(array $departmentCollection)
    {
        $this->departmentCollection = $departmentCollection;
    }

    public function departmentCollection(): array
    {
        return $this->departmentCollection;
    }
}
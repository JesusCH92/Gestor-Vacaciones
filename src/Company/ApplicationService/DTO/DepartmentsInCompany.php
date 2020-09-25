<?php

declare(strict_types=1);

namespace App\Company\ApplicationService\DTO;

final class DepartmentsInCompany
{
    private int $companyId;

    private string $companyName;

    private array $departments;

    public function __construct(int $companyId, string $companyName, array $departments)
    {
        $this->companyId = $companyId;
        $this->companyName = $companyName;
        $this->departments = $departments;
    }

    public function companyId(): int
    {
        return $this->companyId;
    }

    public function companyName(): string
    {
        return $this->companyName;
    }

    public function departments(): array
    {
        return $this->departments;
    }
}
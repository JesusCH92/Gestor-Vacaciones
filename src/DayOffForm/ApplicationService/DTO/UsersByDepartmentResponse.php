<?php

declare(strict_types=1);

namespace App\DayOffForm\ApplicationService\DTO;

final class UsersByDepartmentResponse
{
    private array $usersCollection;

    public function __construct(array $usersCollection)
    {
        $this->usersCollection = $usersCollection;
    }

    public function usersCollection(): array
    {
        return $this->usersCollection;
    }
}
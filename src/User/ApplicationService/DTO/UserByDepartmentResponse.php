<?php

declare(strict_types=1);

namespace App\User\ApplicationService\DTO;

final class UserByDepartmentResponse
{
    private string $userNameAndLastName;
    private string $userId;

    public function __construct(string $userNameAndLastName, string $userId)
    {
        $this->userNameAndLastName = $userNameAndLastName;
        $this->userId = $userId;
    }

    public function userNameAndLastName(): string
    {
        return $this->userNameAndLastName;
    }

    public function userId(): string
    {
        return $this->userId;
    }
}
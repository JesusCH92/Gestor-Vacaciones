<?php

declare(strict_types=1);

namespace App\User\ApplicationService\DTO;

final class UserByIdRequest
{
    private string $userId;

    public function __construct(string $userId)
    {
        $this->userId = $userId;
    }

    public function userId(): string
    {
        return $this->userId;
    }
}
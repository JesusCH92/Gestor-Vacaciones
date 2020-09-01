<?php

namespace App\User\ApplicationService\DTO;

final class UsersByNameRequest
{
    private string $userName;

    public function __construct(string $userName)
    {
        $this->userName = $userName;
    }

    public function userName(): string
    {
        return $this->userName;
    }
}
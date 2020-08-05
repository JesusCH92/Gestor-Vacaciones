<?php

namespace App\Company\ApplicationService\DTO;

use App\User\Domain\User;

final class CompanyRequest
{
    private string $companyName;

    private string $companyId;

    private User $user;

    public function __construct(string $companyName, string $companyId, User $user)
    {
        $this->companyName = $companyName;
        $this->companyId = $companyId;
        $this->user = $user;
    }

    public function companyName() : string
    {
        return $this->companyName;
    }

    public function companyId() : string
    {
        return $this->companyId;
    }

    public function user() : User
    {
        return $this->user;
    }
}
<?php

declare(strict_types=1);

namespace App\DayOffForm\ApplicationService\DTO;

use App\User\Domain\User;

final class LastDayOffFormRequestByUserRequest
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function user(): User
    {
        return $this->user;
    }
}
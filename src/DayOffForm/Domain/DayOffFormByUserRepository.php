<?php

declare(strict_types=1);

namespace App\DayOffForm\Domain;

use App\User\Domain\User;

interface DayOffFormByUserRepository
{
    public function findDayOffFormWithDatesByUser(User $user);
}
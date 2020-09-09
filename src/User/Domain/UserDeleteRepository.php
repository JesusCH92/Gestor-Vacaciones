<?php

declare(strict_types = 1);

namespace App\User\Domain;

interface UserDeleteRepository
{
    public function deleteUser(User $user): void;
}
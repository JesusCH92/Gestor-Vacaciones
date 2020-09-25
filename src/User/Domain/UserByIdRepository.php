<?php

declare(strict_types=1);

namespace App\User\Domain;

interface UserByIdRepository
{
    public function findUserById(string $userId): ?User;
}
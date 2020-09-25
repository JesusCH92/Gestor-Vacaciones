<?php

declare(strict_types=1);

namespace App\User\Domain;

interface UserRepository
{
    public function findUserByEmail(string $email): ?User;

    public function saveUser(User $user): void;
}
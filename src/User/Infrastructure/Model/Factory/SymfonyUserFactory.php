<?php

declare(strict_types=1);

namespace App\User\Infrastructure\Model\Factory;

use App\Entity\Company;
use App\Entity\Department;
use App\User\Domain\Factory\UserFactory;
use App\User\Domain\User;
use App\User\Domain\ValueObject\Roles;
use App\User\Infrastructure\Model\SymfonyUser;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

final class SymfonyUserFactory implements UserFactory
{
    private UserPasswordEncoderInterface $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function register(
        string $name,
        string $lastName,
        string $phone,
        string $email,
        string $password,
        Department $deparment,
        Company $company,
        Roles $roles
    ): User {
        $user = new SymfonyUser($email, $name, $lastName, $phone, $roles, $password, $deparment, $company);

        $encodedPassword = $this->passwordEncoder->encodePassword(
            $user,
            $user->password()
        );

        $user->setPassword($encodedPassword);

        return $user;
    }
}
<?php

declare(strict_types = 1);

namespace App\User\Infrastructure\Model;

use App\User\Domain\User;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="user", options={"collate"="utf8_general_ci", "charset"="utf8"})
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
final class SymfonyUser extends User implements UserInterface
{
    /**
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        //$roles[] = 'ROLE_USER';

        return array_unique($roles->roles());
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
}
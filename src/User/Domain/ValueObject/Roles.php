<?php

declare(strict_types=1);

namespace App\User\Domain\ValueObject;

use App\User\Domain\Exception\InvalidRoleException;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
final class Roles
{
    public const USER = 'ROLE_USER';
    public const SUPERVISOR = 'ROLE_SUPERVISOR';

    public static $allowedValues = [
        self::USER,
        self::SUPERVISOR
    ];

    /**
     * @ORM\Column(type="json", name="roles")
     */
    private array $roles;

    public function __construct(string $roles)
    {
        $this->setRole($roles);
    }

    public function setRole(string $role): void
    {
        if (!in_array($role, static::$allowedValues, true)) {
            throw new InvalidRoleException($role);
        }

        $this->roles = [$role];
    }

    public function roles(): array
    {
        return $this->roles;
    }

    public function __toString(): string
    {
        return $this->roles[0];
    }
}
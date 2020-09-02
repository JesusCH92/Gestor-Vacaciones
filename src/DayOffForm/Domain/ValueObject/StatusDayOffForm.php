<?php


namespace App\DayOffForm\Domain\ValueObject;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Embeddable */
final class StatusDayOffForm
{
    public const PENDING = 'PENDING';
    public const APPROVED = 'APPROVED';
    public const DENIED = 'DENIED';

    public const STATUS = [
        'ROLE_USER' => self::PENDING,
        'ROLE_SUPERVISOR' => self::APPROVED
    ];

    /**
     * @ORM\Column(type="string",name="status_day_off_form", length=15)
     */
    private $statusDayOffForm;


    public function __construct(string $statusDayOffForm = self::PENDING)
    {
        $this->statusDayOffForm = $statusDayOffForm;
    }

    public function statusDayOffForm()
    {
        return $this->statusDayOffForm;
    }

    public function statusByUserRole(string $role): void
    {
        $this->statusDayOffForm = self::STATUS[$role];
    }

    public function acceptDayOff(): self
    {
        return new self(self::APPROVED);
    }

    public function denyDayOff(): self
    {
        return new self(self::DENIED);
    }
}
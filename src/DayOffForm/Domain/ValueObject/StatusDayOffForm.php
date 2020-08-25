<?php


namespace App\DayOffForm\Domain\ValueObject;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Embeddable */
final class StatusDayOffForm
{
    const STATUS = [
        'ROLE_USER' => 'PENDING',
        'ROLE_SUPERVISOR' => 'APPROVED'
    ];

    /**
     * @ORM\Column(type="string",name="status_day_off_form", length=15)
     */
    private $statusDayOffForm;


    public function __construct(string $statusDayOffForm = 'PENDING')
    {
        $this->statusDayOffForm = $statusDayOffForm;
    }

    /**
     * @return mixed
     */
    public function statusDayOffForm()
    {
        return $this->statusDayOffForm;
    }

    public function statusByUserRole( string $role): void
    {
        $this->statusDayOffForm = self::STATUS[$role];
    }

    public function acceptDayOff(): self
    {
        return new self('APPROVED');
    }

    public function denyDayOff(): self
    {
        return new self('REJECTED');
    }
}
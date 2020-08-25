<?php


namespace App\DayOffForm\Domain\ValueObject;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Embeddable */
final class StatusDayOffForm
{

    const STATUS = [
        'HOLIDAY' => [
            'ROLE_USER' => 'PENDING',
            'ROLE_SUPERVISOR' => 'ACCEPTED'
        ],
        'PERSONAL' => [
            'ROLE_USER' => 'PENDING',
            'ROLE_SUPERVISOR' => 'ACCEPTED'
        ],
        'OTHER' => [
            'ROLE_USER' => 'PENDING',
            'ROLE_SUPERVISOR' => 'ACCEPTED'
        ],
        'SICK LEAVE' => [
            'ROLE_USER' => 'PENDING',
            'ROLE_SUPERVISOR' => 'ACCEPTED'
        ]
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

    public function statusByUserRole(string $type, string $role): void
    {
        $this->statusDayOffForm = self::STATUS[$type][$role];
    }

    public function acceptDayOff(): self
    {
        return new self('ACCEPTED');
    }

    public function denyDayOff(): self
    {
        return new self('DENIED');
    }
}
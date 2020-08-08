<?php


namespace App\DayOff\Domain\ValueObject;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Embeddable */
final class StatusDayOffForm
{
    const STATUS = [
        'ROLE_USER' => 'PENDING',
        'ROLE_SUPERVISOR' => 'ACCEPTED'
    ];
    /**
     * @ORM\Column(type="string",name="status_day_off_form", length=15)
     */
    private $statusDayOffForm;


    public function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getStatusDayOffForm()
    {
        return $this->statusDayOffForm;
    }

    public function statusByUserRole(string $role)
    {
        $this->statusDayOffForm= self::STATUS[$role];
    }
}
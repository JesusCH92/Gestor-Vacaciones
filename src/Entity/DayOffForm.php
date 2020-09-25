<?php

namespace App\Entity;

use App\DayOffForm\Domain\ValueObject\CountDayOffRequest;
use App\User\Domain\User;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;


/**
 * @ORM\Entity
 * @ORM\Table(name="day_off_form", options={"collate"="utf8_general_ci", "charset"="utf8"})
 */
class DayOffForm
{
    /**
     * @var string
     *
     * @ORM\Column(name="code_day_off_form", type="string", length=36)
     * @ORM\Id
     */

    private $codeDayOffForm;

    /**
     * @ORM\Column(type="string", name="type_day_off", length=30)
     */
    private $typeDayOff;

    /** @ORM\Embedded(class = "App\DayOffForm\Domain\ValueObject\StatusDayOffForm", columnPrefix = false) */
    private $statusDayOffForm;

    /**
     * @ORM\Column(type="string", name="observation", length=255, nullable=true)
     */
    private $observation;

    /** @ORM\Embedded(class = "App\DayOffForm\Domain\ValueObject\CountDayOffRequest", columnPrefix = false) */
    private $countDayOffRequest;

    /**
     * @ORM\Column(type="date_immutable", name="created_at")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=App\User\Infrastructure\Model\SymfonyUser::class)
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id_user", nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="string", name="id_supervisor", length=36, nullable=true)
     */
    private $supervisorId;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Calendar")
     * @ORM\JoinColumn(name="id_calendar", referencedColumnName="id_calendar", nullable=false)
     */
    private $calendar;

    public function __construct(
        $typeDayOff,
        $statusDayOffForm,
        $observation,
        $countDayOffRequest,
        $createdAt,
        $user,
        $supervisorId,
        $calendar
    ) {
        $this->codeDayOffForm = Uuid::uuid4();
        $this->typeDayOff = $typeDayOff;
        $this->statusDayOffForm = $statusDayOffForm;
        $this->observation = $observation;
        $this->countDayOffRequest = $countDayOffRequest;
        $this->createdAt = $createdAt;
        $this->user = $user;
        $this->supervisorId = $supervisorId;
        $this->calendar = $calendar;
    }


    public function codeDayOffForm(): string
    {
        return $this->codeDayOffForm;
    }

    public function typeDayOff(): string
    {
        return $this->typeDayOff;
    }


    public function statusDayOffForm(): string
    {
        return $this->statusDayOffForm;
    }

    public function observation(): ?string
    {
        return $this->observation;
    }


    public function countDayOffRequest(): CountDayOffRequest
    {
        return $this->countDayOffRequest;
    }


    public function createdAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function user(): User
    {
        return $this->user;
    }

    public function supervisorId(): ?string
    {
        return $this->supervisorId;
    }

    public function calendar(): Calendar
    {
        return $this->calendar;
    }
}


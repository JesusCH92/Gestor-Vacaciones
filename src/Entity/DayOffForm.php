<?php

namespace App\Entity;

use App\DayOff\Domain\ValueObject\CountDayOffRequest;
use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;


/**
 * @ORM\Entity(repositoryClass="App\Repository\DayOffFormRepository")
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

    /** @ORM\Embedded(class = "App\DayOff\Domain\ValueObject\StatusDayOffForm", columnPrefix = false) */
    private $statusDayOffForm;

    /**
     * @ORM\Column(type="string", name="observation", length=255, nullable=true)
     */
    private $observation;

    /** @ORM\Embedded(class = "App\DayOff\Domain\ValueObject\CountDayOffRequest", columnPrefix = false) */
    private $countDayOffRequest;

    /**
     * @ORM\Column(type="date_immutable", name="created_at")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=App\User\Domain\User::class)
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id_user", nullable=false)
     */
    private $idUser;

    /**
     * @ORM\Column(type="string", name="id_supervisor", length=36, nullable=true)
     */
    private $idSupervisor;

    /**
     * DayOffForm constructor.
     * @param $typeDayOff
     * @param $statusDayOffForm
     * @param $observation
     * @param $countDayOffRequest
     * @param $idUser
     * @param $idSupervisor
     */
    public function __construct(
        $typeDayOff,
        $statusDayOffForm,
        $observation,
        $countDayOffRequest,
        $idUser,
        $idSupervisor
    ) {
        $this->codeDayOffForm = Uuid::uuid4();
        $this->typeDayOff = $typeDayOff;
        $this->statusDayOffForm = $statusDayOffForm;
        $this->observation = $observation;
        $this->countDayOffRequest = $countDayOffRequest;
        $this->createdAt = new DateTimeImmutable();
        $this->idUser = $idUser;
        $this->idSupervisor = $idSupervisor;
    }


    public function getCodeDayOffForm(): ?string
    {
        return $this->codeDayOffForm;
    }

    public function getTypeDayOff(): ?string
    {
        return $this->typeDayOff;
    }


    public function getStatusDayOffForm(): ?string
    {
        return $this->statusDayOffForm;
    }

    public function getObservation(): ?string
    {
        return $this->observation;
    }


    public function getCountDayOffRequest(): ?CountDayOffRequest
    {
        return $this->countDayOffRequest;
    }


    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getIdUser(): ?string
    {
        return $this->idUser;
    }

    public function getIdSupervisor(): ?string
    {
        return $this->idSupervisor;
    }

}


<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;


/**
 * @ORM\Entity(repositoryClass="App\Repository\DayOffFormRepository")
 * @ORM\Table(name="day_off_form", options={"collate"="utf8_general_ci", "charset"="utf8"})
 */
class DayOffForm
{
    /**
     * @var \Ramsey\Uuid\UuidInterface
     *
     * @ORM\Id
     * @ORM\Column(name="code_day_off_form", type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UuidGenerator::class)
     */
    private $codeDayOffForm;

    /**
     * @ORM\Column(type="string", name="type_day_off", length=30)
     */
    private $typeDayOff;

    /**
     * @ORM\Column(type="string",name="status_day_off_form", length=15)
     */
    private $statusDayOffForm;

    /**
     * @ORM\Column(type="string", name="observation", length=255, nullable=true)
     */
    private $observation;

    /**
     * @ORM\Column(type="integer", name="count_day_off_request")
     */
    private $countDayOffRequest;

    /**
     * @ORM\Column(type="date", name="created_at")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=App\User\Domain\User::class)
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id_user", nullable=false)
     */
    private $idUser;

    /**
     * @ORM\ManyToOne(targetEntity=App\User\Domain\User::class)
     * @ORM\JoinColumn(name="id_supervisor", referencedColumnName="id_user", nullable=false)
     */
    private $idSupervisor;


    public function getCodeDayOffForm(): ?int
    {
        return $this->codeDayOffForm;
    }

    public function getTypeDayOff(): ?string
    {
        return $this->typeDayOff;
    }

    public function setTypeDayOff(string $typeDayOff): self
    {
        $this->typeDayOff = $typeDayOff;

        return $this;
    }

    public function getStatusDayOffForm(): ?string
    {
        return $this->statusDayOffForm;
    }

    public function setStatusDayOffForm(string $statusDayOffForm): self
    {
        $this->statusDayOffForm = $statusDayOffForm;

        return $this;
    }

    public function getObservation(): ?string
    {
        return $this->observation;
    }

    public function setObservation(?string $observation): self
    {
        $this->observation = $observation;

        return $this;
    }

    public function getCountDayOffRequest(): ?int
    {
        return $this->countDayOffRequest;
    }

    public function setCountDayOffRequest(int $countDayOffRequest): self
    {
        $this->countDayOffRequest = $countDayOffRequest;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getIdUser(): ?string
    {
        return $this->idUser;
    }

    public function setIdUser(string $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function getIdSupervisor(): ?string
    {
        return $this->idSupervisor;
    }

    public function setIdSupervisor(?string $idSupervisor): self
    {
        $this->idSupervisor = $idSupervisor;

        return $this;
    }

}


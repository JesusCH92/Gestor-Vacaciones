<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="remaining_day_off_summary_by_user", options={"collate"="utf8_general_ci", "charset"="utf8"})
 */
class RemainingDayOffSummaryByUser
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="id_remaining_day_off_summary_by_user")
     */
    private $remainingDayOffSummaryByUserId;

    /**
     * @ORM\ManyToOne(targetEntity="App\User\Domain\User")
     * @ORM\JoinColumn(nullable=false, name="id_user", referencedColumnName="id_user")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Calendar")
     * @ORM\JoinColumn(nullable=false, name="id_calendar", referencedColumnName="id_calendar")
     */
    private $calendar;

    /**
     * @ORM\Column(type="string", length=30, name="type_day_off")
     */
    private $typeDayOff;

    /**
     * @ORM\Column(type="integer", name="count_type_day_off_remaining")
     */
    private $countTypeDayOffRemaining;

    /**
     * @ORM\Column(type="date_immutable", name="init_date_day_off_request")
     */
    private $initDateDayOffRequest;

    /**
     * @ORM\Column(type="date_immutable", name="end_date_day_off_request")
     */
    private $endDateDayOffRequest;

    /**
     * @ORM\Column(type="integer", name="working_year")
     */
    private $workingYear;

    public function remainingDayOffSummaryByUserId(): ?int
    {
        return $this->remainingDayOffSummaryByUserId;
    }

    public function user(): ?string
    {
        return $this->user;
    }

    public function calendar(): ?Calendar
    {
        return $this->calendar;
    }

    public function typeDayOff(): ?string
    {
        return $this->typeDayOff;
    }

    public function countTypeDayOffRemaining(): ?int
    {
        return $this->countTypeDayOffRemaining;
    }

    public function initDateDayOffRequest(): ?\DateTimeImmutable
    {
        return $this->initDateDayOffRequest;
    }

    public function endDateDayOffRequest(): ?\DateTimeImmutable
    {
        return $this->endDateDayOffRequest;
    }
    
    public function workingYear(): ?int
    {
        return $this->workingYear;
    }
}

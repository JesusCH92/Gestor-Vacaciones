<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="calendar", options={"collate"="utf8_general_ci", "charset"="utf8"})
 */
class Calendar
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="id_calendar")
     */
    private $calendarId;

    // /**
    //  * @ORM\Column(type="date_immutable", name="init_date_work_year")
    //  */
    // private $initDateWorkYear;

    // /**
    //  * @ORM\Column(type="date_immutable", name="end_date_work_year")
    //  */
    // private $endDateWorkYear;

    /**
     * @ORM\Column(type="date_immutable", name="init_date_day_off_request")
     */
    private $initDateDayOffRequest;

    /**
     * @ORM\Column(type="date_immutable", name="end_date_day_off_request")
     */
    private $endDateDayOffRequest;

    /**
     * @ORM\Column(type="json", name="work_days")
     */
    private $workDays = [];

    /**
     * @ORM\Column(type="json", name="no_working_days")
     */
    private $noWorkingDays = [];

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Company", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false, name="id_company", referencedColumnName="id_company")
     */
    private $company;

    /**
     * @ORM\Embedded(class="App\Calendar\Domain\ValueObject\WorkingYear", columnPrefix = false)
     */
    private $workingYear;

    public function __construct($initDateDayOffRequest, $endDateDayOffRequest, $workDays, $noWorkingDays, $company, $workingYear)
    {
        $this->initDateDayOffRequest = $initDateDayOffRequest;
        $this->endDateDayOffRequest = $endDateDayOffRequest;
        $this->workDays = $workDays;
        $this->noWorkingDays = $noWorkingDays;
        $this->company = $company;
        $this->workingYear = $workingYear;
    }

    public function calendarId(): ?int
    {
        return $this->calendarId;
    }

    // public function initDateWorkYear(): ?\DateTimeImmutable
    // {
    //     return $this->initDateWorkYear;
    // }

    // public function endDateWorkYear(): ?\DateTimeImmutable
    // {
    //     return $this->endDateWorkYear;
    // }

    public function initDateDayOffRequest(): ?\DateTimeImmutable
    {
        return $this->initDateDayOffRequest;
    }

    public function endDateDayOffRequest(): ?\DateTimeImmutable
    {
        return $this->endDateDayOffRequest;
    }

    public function workDays(): ?array
    {
        return $this->workDays;
    }

    public function noWorkingDays(): ?array
    {
        return $this->noWorkingDays;
    }

    public function company(): ?Company
    {
        return $this->company;
    }

    public function workingYear(): ?int
    {
        return $this->workingYear;
    }
}
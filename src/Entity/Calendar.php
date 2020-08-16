<?php

namespace App\Entity;

use App\Calendar\Domain\ValueObject\DayOffRequest;
use App\Calendar\Domain\ValueObject\WorkDays;
use App\Calendar\Domain\ValueObject\WorkingYear;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Nonstandard\Uuid;

/**
 * @ORM\Entity
 * @ORM\Table(name="calendar", options={"collate"="utf8_general_ci", "charset"="utf8"})
 */
class Calendar
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", name="id_calendar", unique=true)
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

    // /**
    //  * @ORM\Column(type="date_immutable", name="init_date_day_off_request")
    //  */
    // private $initDateDayOffRequest;

    // /**
    //  * @ORM\Column(type="date_immutable", name="end_date_day_off_request")
    //  */
    // private $endDateDayOffRequest;

    /**
     * @ORM\Embedded(class="App\Calendar\Domain\ValueObject\DayOffRequest", columnPrefix = false)
     */
    private $dayOffRequest;

    /**
     * @ORM\Embedded(class="App\Calendar\Domain\ValueObject\WorkDays", columnPrefix = false)
     */
    private $workDays;

    /**
     * @ORM\Column(type="json", name="no_working_days")
     */
    private $noWorkingDays = [];

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Company")
     * @ORM\JoinColumn(nullable=false, name="id_company", referencedColumnName="id_company")
     */
    private $company;

    /**
     * @ORM\Embedded(class="App\Calendar\Domain\ValueObject\WorkingYear", columnPrefix = false)
     */
    private $workingYear;

    public function __construct(DayOffRequest $dayOffRequest, $workDays, $noWorkingDays, $company, $workingYear)
    {
        $this->calendarId = Uuid::uuid4();
        // $this->initDateDayOffRequest = $initDateDayOffRequest;
        // $this->endDateDayOffRequest = $endDateDayOffRequest;
        $this->dayOffRequest = $dayOffRequest;
        $this->workDays = $workDays;
        $this->noWorkingDays = $noWorkingDays;
        $this->company = $company;
        $this->workingYear = $workingYear;
    }

    public function calendarId(): string
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

    // public function initDateDayOffRequest(): ?\DateTimeImmutable
    // {
    //     return $this->initDateDayOffRequest;
    // }

    // public function endDateDayOffRequest(): ?\DateTimeImmutable
    // {
    //     return $this->endDateDayOffRequest;
    // }

    public function dayOffRequest(): DayOffRequest
    {
        return $this->dayOffRequest;
    }

    public function workDays(): WorkDays
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

    public function workingYear(): ?WorkingYear
    {
        return $this->workingYear;
    }
}
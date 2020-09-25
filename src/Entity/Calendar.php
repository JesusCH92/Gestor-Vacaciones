<?php

namespace App\Entity;

use App\Calendar\Domain\ValueObject\DayOffConfig;
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

    /**
     * @ORM\Embedded(class="App\Calendar\Domain\ValueObject\DayOffConfig", columnPrefix = false)
     */
    private $dayOffConfig;

    /**
     * @ORM\Embedded(class="App\Calendar\Domain\ValueObject\WorkDays", columnPrefix = false)
     */
    private $workDays;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Company")
     * @ORM\JoinColumn(nullable=false, name="id_company", referencedColumnName="id_company")
     */
    private $company;

    /**
     * @ORM\Embedded(class="App\Calendar\Domain\ValueObject\WorkingYear", columnPrefix = false)
     */
    private $workingYear;

    public function __construct(
        DayOffConfig $dayOffConfig,
        WorkDays $workDays,
        Company $company,
        WorkingYear $workingYear
    ) {
        $this->calendarId = Uuid::uuid4();
        $this->dayOffConfig = $dayOffConfig;
        $this->workDays = $workDays;
        $this->company = $company;
        $this->workingYear = $workingYear;
    }

    public function calendarId(): string
    {
        return $this->calendarId;
    }

    public function dayOffConfig(): DayOffConfig
    {
        return $this->dayOffConfig;
    }

    public function workDays(): WorkDays
    {
        return $this->workDays;
    }

    public function company(): Company
    {
        return $this->company;
    }

    public function workingYear(): WorkingYear
    {
        return $this->workingYear;
    }
}
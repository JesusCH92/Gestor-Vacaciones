<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="feastday", options={"collate"="utf8_general_ci", "charset"="utf8"})
 */
class FeastDay
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="id_feastday")
     */
    private $feastdayId;

    /**
     * @ORM\Column(type="date_immutable", name="feastday_date")
     */
    private $feastdayDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Calendar")
     * @ORM\JoinColumn(nullable=false, name="id_calendar", referencedColumnName="id_calendar")
     */
    private $calendar;

    /**
     * @ORM\Column(type="integer", name="working_year")
     */
    private $workingYear;

    public function feastdayId(): ?int
    {
        return $this->feastdayId;
    }

    public function feastdayDate(): ?\DateTimeImmutable
    {
        return $this->feastdayDate;
    }

    public function calendar(): ?Calendar
    {
        return $this->calendar;
    }
    
    public function workingYear(): ?int
    {
        return $this->workingYear;
    }
}

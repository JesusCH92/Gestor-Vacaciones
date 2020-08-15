<?php

namespace App\Entity;

use App\Featsday\Domain\ValueObject\FeastdayDate;
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
     * @ORM\Embedded(class="App\Featsday\Domain\ValueObject\FeastdayDate", columnPrefix = false)
     */
    private $feastdayDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Calendar")
     * @ORM\JoinColumn(nullable=false, name="id_calendar", referencedColumnName="id_calendar")
     */
    private $calendar;

    public function __construct(FeastdayDate $feastdayDate, Calendar $calendar)
    {
        $this->feastdayDate = $feastdayDate;
        $this->calendar = $calendar;
    }

    public function feastdayId(): int
    {
        return $this->feastdayId;
    }

    public function feastdayDate(): FeastdayDate
    {
        return $this->feastdayDate;
    }

    public function calendar(): Calendar
    {
        return $this->calendar;
    }
}

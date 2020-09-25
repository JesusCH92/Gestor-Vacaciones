<?php

namespace App\Entity;

use App\TypeDayOff\Domain\ValueObject\CountDayOff;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="type_day_off", options={"collate"="utf8_general_ci", "charset"="utf8"})
 */
class TypeDayOff
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="id_type_day_off")
     */
    private $typeDayOffId;

    /**
     * @ORM\Column(type="string", name="type_day_off", length=30)
     */
    private $typeDayOff;

    /**
     * @ORM\Embedded(class="App\TypeDayOff\Domain\ValueObject\CountDayOff", columnPrefix = false)
     */
    private $countDayOff;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Calendar")
     * @ORM\JoinColumn(nullable=false, name="id_calendar", referencedColumnName="id_calendar")
     */
    private $calendar;

    public function __construct(string $typeDayOff, CountDayOff $countDayOff, Calendar $calendar)
    {
        $this->typeDayOff = $typeDayOff;
        $this->countDayOff = $countDayOff;
        $this->calendar = $calendar;
    }

    public function typeDayOffId(): int
    {
        return $this->typeDayOffId;
    }

    public function typeDayOff(): string
    {
        return $this->typeDayOff;
    }

    public function countDayOff(): CountDayOff
    {
        return $this->countDayOff;
    }

    public function calendar(): Calendar
    {
        return $this->calendar;
    }
}

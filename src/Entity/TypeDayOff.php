<?php

namespace App\Entity;

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
     * @ORM\Column(type="integer", name="count_day_off")
     */
    private $countDayOff;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Calendar")
     * @ORM\JoinColumn(nullable=false, name="id_calendar", referencedColumnName="id_calendar")
     */
    private $calendar;
    
    public function typeDayOffId(): ?int
    {
        return $this->typeDayOffId;
    }

    public function typeDayOff(): ?string
    {
        return $this->typeDayOff;
    }

    public function countDayOff(): ?int
    {
        return $this->countDayOff;
    }

    public function calendar(): ?Calendar
    {
        return $this->calendar;
    }
}

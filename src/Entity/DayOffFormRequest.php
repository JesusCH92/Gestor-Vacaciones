<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="day_off_form_request", options={"collate"="utf8_general_ci", "charset"="utf8"})
 */
class DayOffFormRequest
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=DayOffForm::class)
     * @ORM\JoinColumn(name="code_day_off_form", referencedColumnName="code_day_off_form", nullable=false)
     */
    private $dayOffForm;


    /** @ORM\Embedded(class = "App\DayOffForm\Domain\ValueObject\DayOffSelected", columnPrefix = false) */
    private $dayOffSelected;

    /**
     * DayOffFormRequest constructor.
     * @param $codeDayOffForm
     * @param $dayOffSelected
     */
    public function __construct($dayOffForm, $dayOffSelected)
    {
        $this->dayOffForm = $dayOffForm;
        $this->dayOffSelected = $dayOffSelected;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function dayOffSelected()
    {
        return $this->dayOffSelected;
    }


    public function dayOffForm()
    {
        return $this->dayOffForm;
    }

}

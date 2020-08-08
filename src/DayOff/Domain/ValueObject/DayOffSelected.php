<?php


namespace App\DayOff\Domain\ValueObject;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Exception;

/** @ORM\Embeddable */
final class DayOffSelected
{
    /**
     * @ORM\Column(type="date_immutable")
     */
    private $dayOffSelected;

    /**
     * DayOffSelected constructor.
     * @param $dayOffSelected
     * @throws Exception
     */
    public function __construct($dayOffSelected)
    {
        $this->dayOffSelected = new DateTimeImmutable($dayOffSelected);
    }

    /**
     * @return mixed
     */
    public function getDayOffSelected()
    {
        return $this->dayOffSelected;
    }


}
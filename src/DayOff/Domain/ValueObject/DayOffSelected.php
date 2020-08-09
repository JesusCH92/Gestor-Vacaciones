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
    public function __construct(string $dayOffSelected)
    {
        $this->checkCorrectDateType($dayOffSelected);
        $this->dayOffSelected = new DateTimeImmutable($dayOffSelected);
    }

    public function checkCorrectDateType(string $dayOffSelected)
    {
        $date = explode('-', $dayOffSelected);
        $this->checkCorrectYearType($date[0]);
        $this->checkCorrectMonthType($date[1]);
        $this->checkCorrectDayType($date[2]);
    }

    public function checkCorrectYearType(string $year): void
    {
        if (!4 === strlen($year) || date("Y") > date($year)) {
            //exception
        }
    }

    public function checkCorrectMonthType(string $month): void
    {
        if (!2 === strlen($month) || 12 < (int)$month) {
            //exception
        }
    }

    public function checkCorrectDayType(string $day): void
    {
        if (!2 === strlen($day) || 31 < (int)$day) {
            //exception
        }
    }

    /**
     * @return mixed
     */
    public function dayOffSelected()
    {
        return $this->dayOffSelected;
    }

}
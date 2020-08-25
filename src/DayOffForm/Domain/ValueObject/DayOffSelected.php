<?php


namespace App\DayOffForm\Domain\ValueObject;

use App\DayOff\Domain\Exception\InvalidDateTypeException;
use App\DayOff\Domain\Exception\InvalidDayOffSelectedException;
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

    private function checkCorrectDateType(string $dayOffSelected)
    {
        $date = explode('-', $dayOffSelected);
        if (!checkdate($date[1], $date[2], $date[0])) {
            throw new InvalidDateTypeException();
        }
        /*$this->checkCorrectYearType($date[0]);
        $this->checkCorrectMonthType($date[1]);
        $this->checkCorrectDayType($date[2]);
        */
    }

    /**
     * @return mixed
     */
    public function dayOffSelected()
    {
        return $this->dayOffSelected;
    }

    public function isCorrectDaySelectedTiming($initDate, $endDate)
    {
        if ($initDate > $this->dayOffSelected || $endDate < $this->dayOffSelected) {
            throw new InvalidDayOffSelectedException($initDate, $endDate);
        }
    }

    private function checkCorrectYearType(string $year): void
    {
        if (!4 === strlen($year) || date("Y") > date($year)) {
            throw new InvalidDateTypeException();
        }
    }

    private function checkCorrectMonthType(string $month): void
    {
        if (!2 === strlen($month) || 12 < (int)$month) {
            throw new InvalidDateTypeException();
        }
    }

    private function checkCorrectDayType(string $day): void
    {
        if (!2 === strlen($day) || 31 < (int)$day) {
            throw new InvalidDateTypeException();
        }
    }

}
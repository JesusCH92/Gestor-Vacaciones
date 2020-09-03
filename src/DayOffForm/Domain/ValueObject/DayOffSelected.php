<?php


namespace App\DayOffForm\Domain\ValueObject;

use App\DayOffForm\Domain\Exception\InvalidDateTypeException;
use App\DayOffForm\Domain\Exception\InvalidDayOffSelectedException;
use App\DayOffForm\Domain\Exception\InvalidLowerDateSelectedThanCurrentDate;
use App\Entity\TypeDayOff;
use App\TypeDayOff\Domain\Constants\DayOff;
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
    }

    public function dayOffSelected()
    {
        return $this->dayOffSelected;
    }

    public function validCorrectDaySelectedTiming($initDate, $endDate)
    {
        if ($initDate > $this->dayOffSelected || $endDate < $this->dayOffSelected) {
            throw new InvalidDayOffSelectedException($initDate, $endDate);
        }
    }

    public function validDateBeforeThanCurrentDateByTypeDayOff(string $typeDayOff)
    {
        if (DayOff::WORKOFF !== $typeDayOff && date('Y-m-d') > $this->dayOffSelected->format('Y-m-d')) {
            throw new InvalidLowerDateSelectedThanCurrentDate();
        }
    }

}
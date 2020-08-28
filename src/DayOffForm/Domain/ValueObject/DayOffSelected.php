<?php


namespace App\DayOffForm\Domain\ValueObject;

use App\DayOffForm\Domain\Exception\InvalidDateTypeException;
use App\DayOffForm\Domain\Exception\InvalidDayOffSelectedException;
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

    public function isCorrectDaySelectedTiming($initDate, $endDate)
    {
        if ($initDate > $this->dayOffSelected || $endDate < $this->dayOffSelected) {
            throw new InvalidDayOffSelectedException($initDate, $endDate);
        }
    }

}
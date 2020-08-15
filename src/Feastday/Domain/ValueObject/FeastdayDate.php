<?php

declare(strict_types = 1);

namespace App\Featsday\Domain\ValueObject;

use App\Calendar\Domain\Exception\InvalidWorkingYearException;
use App\Featsday\Domain\Exception\InvalidDateException;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
final class FeastdayDate
{
    /**
     * @ORM\Column(type="date_immutable", name="feastday_date")
     */
    private $feastdayDate;

    public function __construct(string $feastdayDate)
    {
        $this->isValidDate($feastdayDate);
        $this->feastdayDate = new DateTimeImmutable($feastdayDate);
    }

    public function isValidDate(string $date): void
    {
        $dateByYearAndMonthAndDay = explode('-', $date);
        $year = intval($dateByYearAndMonthAndDay[0]);
        $month = intval($dateByYearAndMonthAndDay[1]);
        $day = intval($dateByYearAndMonthAndDay[2]);

        if (!checkdate($month, $day, $year) && 3 === count($date)) {
            throw new InvalidDateException($date);
        }

        if ($year < 2019) {
            throw new InvalidWorkingYearException();
        }
    }

    public function feastdayDate(): DateTimeImmutable
    {
        return $this->feastdayDate;
    }
}
<?php

declare(strict_types = 1);

namespace App\Calendar\Domain\ValueObject;

use App\Calendar\Domain\Exception\InvalidDayOffRequestDates;
use App\Calendar\Domain\Exception\InvalidWorkingYearException;
use App\Feastday\Domain\Exception\InvalidDateException;
use Doctrine\ORM\Mapping as ORM;
use DateTimeImmutable;

/**
 * @ORM\Embeddable
 */
final class DayOffConfig
{
    /**
     * @ORM\Column(type="date_immutable", name="init_date_day_off_request")
     */
    private $initDateDayOffRequest;

    /**
     * @ORM\Column(type="date_immutable", name="end_date_day_off_request")
     */
    private $endDateDayOffRequest;

    public function __construct(string $initDateDayOffRequest, string $endDateDayOffRequest)
    {
        $this->setDayOffConfig($initDateDayOffRequest, $endDateDayOffRequest);
    }

    public function initDateDayOffRequest(): DateTimeImmutable
    {
        return $this->initDateDayOffRequest;
    }

    public function endDateDayOffRequest(): DateTimeImmutable
    {
        return $this->endDateDayOffRequest;
    }

    public function guardAreValidDayOffRequestDates($initDate, $endDate): void
    {
        if ($this->isValidDate($initDate)) {
            throw new InvalidDateException($initDate);
        }

        if ($this->isDateLessThanTwentyNineteen($initDate)) {
            throw new InvalidWorkingYearException();
        }

        if ($this->isValidDate($endDate)) {
            throw new InvalidDateException($endDate);
        }

        if ($this->isDateLessThanTwentyNineteen($endDate)) {
            throw new InvalidWorkingYearException();
        }

        if ($this->isEndDateIsGreaterOrEqualThanInitDate($initDate, $endDate)) {
            throw new InvalidDayOffRequestDates($initDate, $endDate);
        }
    }

    public function isEndDateIsGreaterOrEqualThanInitDate(string $initDate, string $endDate): bool
    {
        return new DateTimeImmutable($endDate) <= new DateTimeImmutable($initDate);
    }

    public function isValidDate(string $date): bool
    {
        $dateByYearAndMonthAndDay = explode('-', $date);
        $year = intval($dateByYearAndMonthAndDay[0]);
        $month = intval($dateByYearAndMonthAndDay[1]);
        $day = intval($dateByYearAndMonthAndDay[2]);

        return (!checkdate($month, $day, $year) && 3 === count($dateByYearAndMonthAndDay));
    }

    public function isDateLessThanTwentyNineteen(string $date): bool
    {
        $dateByYearAndMonthAndDay = explode('-', $date);
        $year = intval($dateByYearAndMonthAndDay[0]);

        return $year < 2019;
    }

    public function setDayOffConfig(string $initDate, string $endDate): void
    {
        $this->guardAreValidDayOffRequestDates($initDate, $endDate);
        $this->initDateDayOffRequest = new DateTimeImmutable($initDate);
        $this->endDateDayOffRequest = new DateTimeImmutable($endDate);
    }
}
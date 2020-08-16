<?php

declare(strict_types = 1);

namespace App\Calendar\Domain\ValueObject;

use App\Calendar\Domain\Exception\InvalidDayOffRequestDates;
use Doctrine\ORM\Mapping as ORM;
use DateTimeImmutable;
// use Doctrine\DBAL\Types\DateImmutableType;

/**
 * @ORM\Embeddable
 */
final class DayOffRequest
{
    /**
     * @ORM\Column(type="date_immutable", name="init_date_day_off_request")
     */
    private $initDateDayOffRequest;

    /**
     * @ORM\Column(type="date_immutable", name="end_date_day_off_request")
     */
    private $endDateDayOffRequest;

    public function __construct($initDateDayOffRequest, $endDateDayOffRequest)
    {
        $this->guardAreValidDayOffRequestDates($initDateDayOffRequest, $endDateDayOffRequest);
        $this->initDateDayOffRequest = $initDateDayOffRequest;
        $this->endDateDayOffRequest = $endDateDayOffRequest;
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
        if ($this->isEndDateIsGreaterOrEqualThanInitDate($initDate, $endDate)) {
            $initDateToString = $initDate->format('Y-m-d');
            $endDateToString = $endDate->format('Y-m-d');
            throw new InvalidDayOffRequestDates($initDateToString, $endDateToString);
        }
    }

    public function isEndDateIsGreaterOrEqualThanInitDate($initDate, $endDate): bool
    {
        return $endDate <= $initDate;
    }
}
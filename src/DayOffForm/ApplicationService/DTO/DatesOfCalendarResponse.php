<?php

declare(strict_types = 1);

namespace App\DayOffForm\ApplicationService\DTO;

final class DatesOfCalendarResponse
{
    private string $year;
    private string $month;
    private array $week;

    public function __construct(string $year, string $month, array $week)
    {
        $this->year = $year;
        $this->month = $month;
        $this->week = $week;
    }

    public function year(): string
    {
        return $this->year;
    }

    public function month(): string
    {
        return $this->month;
    }

    public function week(): array
    {
        return $this->week;
    }
}
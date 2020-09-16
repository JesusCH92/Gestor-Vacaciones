<?php

declare(strict_types=1);

namespace App\DayOffForm\ApplicationService\DTO;

final class DateByTypeByStatusResponse
{
    private string $typeDayOff;
    private string $statusDayOff;
    private string $date;

    public function __construct(string $typeDayOff, string $statusDayOff, string $date)
    {
        $this->typeDayOff = $typeDayOff;
        $this->statusDayOff = $statusDayOff;
        $this->date = $date;
    }

    public function typeDayOff(): string
    {
        return $this->typeDayOff;
    }

    public function statusDayOff(): string
    {
        return $this->statusDayOff;
    }

    public function date(): string
    {
        return $this->date;
    }
}
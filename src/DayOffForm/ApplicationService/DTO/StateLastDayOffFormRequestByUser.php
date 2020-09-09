<?php


namespace App\DayOffForm\ApplicationService\DTO;


final class StateLastDayOffFormRequestByUser
{
    private string $statusLastDayOff;

    public function __construct(string $statusLastDayOff)
    {
        $this->statusLastDayOff = $statusLastDayOff;
    }

    public function statusLastDayOff(): string
    {
        return $this->statusLastDayOff;
    }
}
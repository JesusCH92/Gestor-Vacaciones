<?php

declare(strict_types=1);

namespace App\DayOffForm\ApplicationService\DTO;

final class RemainingDaysOffResponse
{
    private array $remainingDaysOff;

    public function __construct(array $remainingDaysOff)
    {
        $this->remainingDaysOff = $remainingDaysOff;
    }

    public function remainingDaysOff(): array
    {
        return $this->remainingDaysOff;
    }
}
<?php

declare(strict_types = 1);

namespace App\TypeDayOff\ApplicationService\DTO;

final class TypeDayOffRequest
{
    private string $calendarId;
    private string $dayOffType;
    private string $dayOffNumber;

    public function __construct(string $calendarId, string $dayOffType, string $dayOffNumber)
    {
        $this->calendarId = $calendarId;
        $this->dayOffType = $dayOffType;
        $this->dayOffNumber = $dayOffNumber;
    }

    public function calendarId(): string
    {
        return $this->calendarId;
    }

    public function dayOffType(): string
    {
        return $this->dayOffType;
    }

    public function dayOffNumber(): string
    {
        return $this->dayOffNumber;
    }
}
<?php

declare(strict_types=1);

namespace App\Calendar\ApplicationService\DTO;

final class CalendarConfigResponse
{
    private string $calendarId;
    private int $workingYear;
    private string $initDate;
    private string $endDate;
    private array $workDays;
    private array $typeDayOffCollection;
    private array $feastdayCollection;

    public function __construct(
        string $calendarId,
        int $workingYear,
        string $initDate,
        string $endDate,
        array $workDays,
        array $typeDayOffCollection,
        array $feastdayCollection
    ) {
        $this->calendarId = $calendarId;
        $this->workingYear = $workingYear;
        $this->initDate = $initDate;
        $this->endDate = $endDate;
        $this->workDays = $workDays;
        $this->typeDayOffCollection = $typeDayOffCollection;
        $this->feastdayCollection = $feastdayCollection;
    }

    public function calendarId(): string
    {
        return $this->calendarId;
    }

    public function workingYear(): int
    {
        return $this->workingYear;
    }

    public function initDate()
    {
        return $this->initDate;
    }

    public function endDate()
    {
        return $this->endDate;
    }

    public function workDays(): array
    {
        return $this->workDays;
    }

    public function typeDayOffCollection(): array
    {
        return $this->typeDayOffCollection;
    }

    public function feastdayCollection(): array
    {
        return $this->feastdayCollection;
    }
}
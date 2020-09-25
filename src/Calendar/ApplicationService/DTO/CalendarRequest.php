<?php

declare(strict_types=1);

namespace App\Calendar\ApplicationService\DTO;

use App\Entity\Company;

final class CalendarRequest
{
    private string $workingYear;
    private string $initDateRequest;
    private string $endDateRequest;
    private string $holidaysNumber;
    private string $personalDayNumber;
    private array $workDays;
    private array $feastdayCollection;
    private Company $company;

    public function __construct(
        string $workingYear,
        string $initDateRequest,
        string $endDateRequest,
        string $holidaysNumber,
        string $personalDayNumber,
        array $workDays,
        array $feastdayCollection,
        Company $company
    ) {
        $this->workingYear = $workingYear;
        $this->initDateRequest = $initDateRequest;
        $this->endDateRequest = $endDateRequest;
        $this->holidaysNumber = $holidaysNumber;
        $this->personalDayNumber = $personalDayNumber;
        $this->workDays = $workDays;
        $this->feastdayCollection = $feastdayCollection;
        $this->company = $company;
    }

    public function workingYear(): string
    {
        return $this->workingYear;
    }

    public function initDateRequest(): string
    {
        return $this->initDateRequest;
    }

    public function endDateRequest(): string
    {
        return $this->endDateRequest;
    }

    public function holidaysNumber(): string
    {
        return $this->holidaysNumber;
    }

    public function personalDayNumber(): string
    {
        return $this->personalDayNumber;
    }

    public function workDays(): array
    {
        return $this->workDays;
    }

    public function feastdayCollection(): array
    {
        return $this->feastdayCollection;
    }

    public function company(): Company
    {
        return $this->company;
    }
}
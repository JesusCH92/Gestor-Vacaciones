<?php

declare(strict_types=1);

namespace App\DayOffForm\ApplicationService\DTO;

final class UserInDayOffFormResponse
{
    private string $userId;
    private string $email;
    private string $userName;
    private string $lastName;
    private string $codeDayOffForm;
    private array $daysOffRequest;

    public function __construct(
        string $userId,
        string $email,
        string $userName,
        string $lastName,
        string $codeDayOffForm,
        array $daysOffRequest
    ) {
        $this->userId = $userId;
        $this->email = $email;
        $this->userName = $userName;
        $this->lastName = $lastName;
        $this->codeDayOffForm = $codeDayOffForm;
        $this->daysOffRequest = $daysOffRequest;
    }

    public function userId(): string
    {
        return $this->userId;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function userName(): string
    {
        return $this->userName;
    }

    public function lastName(): string
    {
        return $this->lastName;
    }

    public function codeDayOffForm(): string
    {
        return $this->codeDayOffForm;
    }

    public function daysOffRequest(): array
    {
        return $this->daysOffRequest;
    }
}
<?php


namespace App\DayOffForm\ApplicationService\DTO;


final class UserInDayOffFormResponse
{
    private string $userId;
    private string $userName;
    private string $lastName;
    private string $codeDayOffForm;
    private array $daysOffRequest;

    public function __construct(string $userId, string $userName, string $lastName, string $codeDayOffForm, array $daysOffRequest)
    {
        $this->userId = $userId;
        $this->userName = $userName;
        $this->lastName = $lastName;
        $this->codeDayOffForm = $codeDayOffForm;
        $this->daysOffRequest = $daysOffRequest;
    }

    public function userId(): string
    {
        return $this->userId;
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
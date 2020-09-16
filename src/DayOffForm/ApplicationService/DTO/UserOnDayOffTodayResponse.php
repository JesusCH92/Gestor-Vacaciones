<?php

declare(strict_types=1);

namespace App\DayOffForm\ApplicationService\DTO;

final class UserOnDayOffTodayResponse
{
    private string $email;
    private string $name;
    private string $lastname;
    private string $typeDayOff;

    public function __construct(string $email, string $name, string $lastname, string $typeDayOff)
    {
        $this->email = $email;
        $this->name = $name;
        $this->lastname = $lastname;
        $this->typeDayOff = $typeDayOff;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function lastname(): string
    {
        return $this->lastname;
    }

    public function typeDayOff(): string
    {
        return $this->typeDayOff;
    }
}
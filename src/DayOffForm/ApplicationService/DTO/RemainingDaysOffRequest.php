<?php


namespace App\DayOffForm\ApplicationService\DTO;


use App\Entity\Calendar;
use App\User\Domain\User;

final class RemainingDaysOffRequest
{
    private Calendar $calendar;
    private User $user;
    private array $typeDayOffCollection;

    public function __construct(Calendar $calendar, User $user, array $typeDayOffCollection)
    {
        $this->calendar = $calendar;
        $this->user = $user;
        $this->typeDayOffCollection =$typeDayOffCollection;
    }

    public function calendar(): Calendar
    {
        return $this->calendar;
    }

    public function user(): User
    {
        return $this->user;
    }

    public function typeDayOffCollection(): array
    {
        return $this->typeDayOffCollection;
    }
}
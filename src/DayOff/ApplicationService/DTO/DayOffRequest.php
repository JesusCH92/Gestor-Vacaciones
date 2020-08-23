<?php


namespace App\DayOff\ApplicationService\DTO;

use App\Entity\Calendar;
use App\User\Domain\User;

final class DayOffRequest
{
    private User $user;
    private Calendar $calendar;
    private string $typeDayOffSelected;
    private array $daysOffSelected;
    private array $typeDayOffCollection;
    private array $feastdaysCollection;

    public function __construct(
        User $user,
        Calendar $calendar,
        string $typeDayOffSelected,
        array $daysOffSelected,
        array $typeDayOffCollection,
        array $feastdaysCollection
    ) {
        $this->user = $user;
        $this->calendar = $calendar;
        $this->typeDayOffSelected = $typeDayOffSelected;
        $this->daysOffSelected = $daysOffSelected;
        $this->typeDayOffCollection = $typeDayOffCollection;
        $this->feastdaysCollection = $feastdaysCollection;
    }

    public function user(): User
    {
        return $this->user;
    }

    public function calendar(): Calendar
    {
        return $this->calendar;
    }

    public function typeDayOffSelected(): string
    {
        return $this->typeDayOffSelected;
    }

    public function daysOffSelected(): array
    {
        return $this->daysOffSelected;
    }

    public function typeDayOffCollection(): array
    {
        return $this->typeDayOffCollection;
    }

    public function feastdaysCollection(): array
    {
        return $this->feastdaysCollection;
    }

}
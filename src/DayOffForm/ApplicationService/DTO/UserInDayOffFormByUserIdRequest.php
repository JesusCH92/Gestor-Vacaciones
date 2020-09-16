<?php

declare(strict_types=1);

namespace App\DayOffForm\ApplicationService\DTO;

use App\Entity\Calendar;

final class UserInDayOffFormByUserIdRequest
{
    private Calendar $calendar;
    private string $userId;

    public function __construct(Calendar $calendar, string $userId)
    {
        $this->calendar = $calendar;
        $this->userId = $userId;
    }

    public function userId(): string
    {
        return $this->userId;
    }

    public function calendar(): Calendar
    {
        return $this->calendar;
    }
}
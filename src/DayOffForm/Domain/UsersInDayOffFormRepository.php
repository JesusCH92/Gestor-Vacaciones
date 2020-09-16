<?php

declare(strict_types=1);

namespace App\DayOffForm\Domain;

use App\DayOffForm\Domain\DTO\UsersInDayOffFormFilteredRequest;
use App\Entity\Calendar;

interface UsersInDayOffFormRepository
{
    public function userInDayOffByFilteringType(UsersInDayOffFormFilteredRequest $usersInDayOffFormFilteredRequest
    ): array;

    public function findDayOffFormRequestByCalendarUserId(Calendar $calendar, string $userId): array;
}
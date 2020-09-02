<?php


namespace App\DayOffForm\Domain;


use App\DayOffForm\Domain\DTO\UsersInDayOffFormFilteredRequest;
use App\Entity\Calendar;

interface UsersInDayOffFormRepository
{
    public function filterUserInDayOff(UsersInDayOffFormFilteredRequest $usersInDayOffFormFilteredRequest): array;
    public function findDayOffFormRequestByCalendarUserId(Calendar $calendar, string $userId): array;
}
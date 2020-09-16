<?php

declare(strict_types=1);

namespace App\DayOffForm\Domain;

use App\Entity\Calendar;
use App\Entity\DayOffForm;
use App\User\Domain\User;

interface DayOffRepository
{
    public function saveDayOffForm(DayOffForm $dayOffForm, array $dayOffFormRequestCollection): void;

    public function findByUserAndStatusDayOffForm(User $user, Calendar $calendar, string $typeDayOffForm): array;

    public function approveDayOffForm(string $dayOffFormId, string $observation, string $supervisorId);

    public function denyDayOffForm(string $dayOffFormId, string $observation, string $supervisorId);

    public function findByCalendarByUser(Calendar $calendar, string $userId): array;

    public function findUsersInDayOffToday(): array;

    public function findLastDayOffFormRequestByUser(User $user);
}
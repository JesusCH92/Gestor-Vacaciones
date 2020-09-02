<?php


namespace App\DayOffForm\Domain;

use App\Entity\Calendar;
use App\Entity\DayOffForm;
use App\User\Domain\User;

interface DayOffRepository
{
    public function findOne(User $userId);
    public function saveDayOffForm(DayOffForm $dayOffForm, array $dayOffFormRequestCollection): void;
    public function findByUserAndStatusDayOffForm(User $user,Calendar $calendar, string $typeDayOffForm): array;
    public function approveDayOffForm(string $dayOffFormId, string $observation, string $supervisorId);
    public function denyDayOffForm(string $dayOffFormId, string $observation, string $supervisorId);
    public function findByCalendar(Calendar $calendar);
    public function findByDepartmentAndUsername(Calendar $calendar, string $userName, int $departmentId);
}
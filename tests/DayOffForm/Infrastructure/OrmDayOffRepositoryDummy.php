<?php


namespace App\Tests\DayOffForm\Infrastructure;


use App\DayOffForm\Domain\DayOffRepository;
use App\Entity\Calendar;
use App\Entity\DayOffForm;
use App\User\Domain\User;

class OrmDayOffRepositoryDummy implements DayOffRepository
{

    public function findOne(User $userId)
    {

    }

    public function saveDayOffForm(DayOffForm $dayOffForm, array $dayOffFormRequestCollection): void
    {

    }

    public function findByUserAndStatusDayOffForm(User $user, Calendar $calendar, string $typeDayOffForm): array
    {
        return [];
    }

    public function approveDayOffForm(string $dayOffFormId, string $observation, string $supervisorId)
    {

    }

    public function denyDayOffForm(string $dayOffFormId, string $observation, string $supervisorId)
    {

    }

    public function findByCalendar(Calendar $calendar)
    {

    }

    public function findByDepartmentAndUsername(Calendar $calendar, string $userName, int $departmentId)
    {

    }

    public function findByCalendarByUser(Calendar $calendar, string $userId): array
    {
        return [];
    }

    public function findUsersInDayOffToday(): array
    {
        return [];
    }

    public function findLastDayOffFormRequestByUser(User $user)
    {

    }
}
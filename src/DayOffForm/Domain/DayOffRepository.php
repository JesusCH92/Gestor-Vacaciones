<?php


namespace App\DayOffForm\Domain;


use App\Entity\DayOffForm;
use App\Entity\DayOffFormRequest;
use App\User\Domain\User;

interface DayOffRepository
{
    public function findOne(User $userId);
    public function saveDayOffForm(DayOffForm $dayOffForm, array $dayOffFormRequestCollection);
    public function findByUserAndStatusDayOffForm(User $user);
}
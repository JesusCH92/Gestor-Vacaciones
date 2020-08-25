<?php


namespace App\DayOffForm\Domain;


use App\Entity\DayOffForm;
use App\Entity\DayOffFormRequest;
use App\User\Domain\User;

interface DayOffRepository
{
    public function findOne(User $userId);
    public function saveDayOffForm(DayOffForm $dayOffForm);
    public function saveDayOffFormRequest(DayOffFormRequest $dayOffFormRequest);
}
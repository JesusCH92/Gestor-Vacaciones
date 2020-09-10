<?php


namespace App\DayOffForm\ApplicationService\DTO;


use App\User\Domain\User;

class LastDayOffFormRequestByUserRequest
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function user(): User
    {
        return $this->user;
    }

}
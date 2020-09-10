<?php

declare(strict_types = 1);

namespace App\DayOffForm\ApplicationService;

use App\DayOffForm\Domain\DayOffFormByUserRepository;
use App\User\Domain\User;

final class GetAllFormRequestByUser
{
    private DayOffFormByUserRepository $dayOffFormByUserRepository;

    public function __construct(DayOffFormByUserRepository $dayOffFormByUserRepository)
    {
        $this->dayOffFormByUserRepository = $dayOffFormByUserRepository;
    }

    public function __invoke(User $user)
    {
        return $this->dayOffFormByUserRepository->findDayOffFormWithDatesByUser($user);
    }
}
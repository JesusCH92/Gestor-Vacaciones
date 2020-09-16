<?php

declare(strict_types=1);

namespace App\DayOffForm\ApplicationService;

use App\DayOffForm\ApplicationService\DTO\UserInDayOffFormByUserIdRequest;
use App\DayOffForm\Domain\UsersInDayOffFormRepository;

final class FindDatesDayOffFormByUser
{
    private UsersInDayOffFormRepository $usersInDayOffFormRepository;

    public function __construct(UsersInDayOffFormRepository $usersInDayOffFormRepository)
    {
        $this->usersInDayOffFormRepository = $usersInDayOffFormRepository;
    }

    public function __invoke(UserInDayOffFormByUserIdRequest $userInDayOffFormByUserIdRequest): array
    {
        $usersInDayOffApproved = $this->usersInDayOffFormRepository->findDayOffFormRequestByCalendarUserId($userInDayOffFormByUserIdRequest->calendar(),
            $userInDayOffFormByUserIdRequest->userId());

        return FindDatesDayOffFormByDepartmentByUserName::mappingUsersInDayOffCollection($usersInDayOffApproved);
    }
}
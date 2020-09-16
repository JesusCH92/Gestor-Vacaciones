<?php

declare(strict_types=1);

namespace App\DayOffForm\ApplicationService;

use App\DayOffForm\ApplicationService\DTO\UserByDepartmentRequest;
use App\DayOffForm\ApplicationService\DTO\UsersByDepartmentResponse;
use App\DayOffForm\Domain\UserDayOffRequestRepository;

final class GetUsersWithPendingStatus
{
    private UserDayOffRequestRepository $userDayOffRequestRepository;

    public function __construct(UserDayOffRequestRepository $userDayOffRequestRepository)
    {
        $this->userDayOffRequestRepository = $userDayOffRequestRepository;
    }

    public function __invoke(UserByDepartmentRequest $userByDepartmentRequest): UsersByDepartmentResponse
    {
        $usersRequest = $this->userDayOffRequestRepository->findUsersByDepartmentByPendingStatus($userByDepartmentRequest->department());

        return new UsersByDepartmentResponse($usersRequest);
    }
}
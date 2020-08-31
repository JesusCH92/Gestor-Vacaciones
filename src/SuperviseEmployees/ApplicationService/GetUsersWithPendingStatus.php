<?php


namespace App\SuperviseEmployees\ApplicationService;


use App\SuperviseEmployees\ApplicationService\DTO\UserByDepartmentRequest;
use App\SuperviseEmployees\ApplicationService\DTO\UsersByDeparmentResponse;
use App\SuperviseEmployees\Domain\UserDayOffRequestRepository;

final class GetUsersWithPendingStatus
{
    private UserDayOffRequestRepository $userDayOffRequestRepository;

    public function __construct(UserDayOffRequestRepository $userDayOffRequestRepository)
    {
        $this->userDayOffRequestRepository = $userDayOffRequestRepository;
    }

    public function __invoke(UserByDepartmentRequest $userByDepartmentRequest): UsersByDeparmentResponse
    {
        $usersRequest = $this->userDayOffRequestRepository->findUsersByDepartmentByPendingStatus($userByDepartmentRequest->department());
        return new UsersByDeparmentResponse($usersRequest);

    }
}
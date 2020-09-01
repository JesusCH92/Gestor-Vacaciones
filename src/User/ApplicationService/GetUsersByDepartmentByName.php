<?php


namespace App\User\ApplicationService;


use App\User\ApplicationService\DTO\DepartmentRequest;
use App\User\ApplicationService\DTO\UsersByDepartmentByNameResponse;
use App\User\ApplicationService\DTO\UsersByNameRequest;
use App\User\Domain\UserRepository;

final class GetUsersByDepartmentByName
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(
        UsersByNameRequest $usersByNameRequest,
        DepartmentRequest $departmentRequest
    ): UsersByDepartmentByNameResponse {

        $users = $this->userRepository->getUsersByDepartmentByName();
        return new UsersByDepartmentByNameResponse($users);
    }

}
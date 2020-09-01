<?php


namespace App\User\ApplicationService;


use App\User\ApplicationService\DTO\DepartmentRequest;
use App\User\ApplicationService\DTO\UsersByDepartmentByNameResponse;
use App\User\Domain\UserRepository;

final class GetUsersByDeparment
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(DepartmentRequest $departmentRequest)
    {
        $users = $this->userRepository->getUserByDepartment();
        return new UsersByDepartmentByNameResponse($users);
    }
}
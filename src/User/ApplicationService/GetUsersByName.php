<?php


namespace App\User\ApplicationService;


use App\User\ApplicationService\DTO\UsersByNameRequest;
use App\User\ApplicationService\DTO\UsersByDepartmentByNameResponse;
use App\User\Domain\UserRepository;

class GetUsersByName
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(UsersByNameRequest $usersByNameRequest)
    {
        $users = $this->userRepository->getUserByName();
        return new UsersByDepartmentByNameResponse($users);
    }
}
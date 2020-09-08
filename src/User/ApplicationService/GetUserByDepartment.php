<?php

declare(strict_types = 1);

namespace App\User\ApplicationService;

use App\User\ApplicationService\DTO\UserByDepartmentRequest;
use App\User\ApplicationService\DTO\UserByDepartmentResponse;
use App\User\Infrastructure\Persistence\OrmUserRepository;

final class GetUserByDepartment
{
    private OrmUserRepository $ormUserRepository;

    public function __construct(OrmUserRepository $ormUserRepository)
    {
        $this->ormUserRepository = $ormUserRepository;
    }

    public function __invoke(UserByDepartmentRequest $userByDepartmentRequest)
    {
        $userByDepartmentCollection = $this->ormUserRepository->findUsersByDepartment(
            $userByDepartmentRequest->userName(),
            $userByDepartmentRequest->department()
        );

        return $this->userByDepartmentFormatResponse($userByDepartmentCollection);
    }

    public function userByDepartmentFormatResponse(array $userCollection): array
    {
        $userByDepartmentCollection = [];

        foreach ($userCollection as $user) {
            array_push($userByDepartmentCollection, 
                new UserByDepartmentResponse(
                    $user->name() . ' ' . $user->lastname(),
                    $user->userId()
                    )
                );
        }
        return $userByDepartmentCollection;
    }
}
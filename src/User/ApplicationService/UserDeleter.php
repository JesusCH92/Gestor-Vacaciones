<?php

declare(strict_types = 1);

namespace App\User\ApplicationService;

use App\DayOffForm\ApplicationService\DayOffFormDeleter;
use App\DayOffForm\ApplicationService\DayOffFormRequestDeleter;
use App\DayOffForm\ApplicationService\GetAllFormRequestByUser;
use App\Entity\DayOffForm;
use App\Entity\DayOffFormRequest;
use App\User\ApplicationService\DTO\UserByIdRequest;
use App\User\ApplicationService\Exception\UserNotFoundException;
use App\User\Domain\UserDeleteRepository;

final class UserDeleter
{
    private FindUserById $findUserById;
    private UserDeleteRepository $userDeleteRepository;
    private GetAllFormRequestByUser $getAllFormRequestByUser;
    private DayOffFormDeleter $dayOffFormDeleter;
    private DayOffFormRequestDeleter $dayOffFormRequestDeleter;

    public function __construct(FindUserById $findUserById, UserDeleteRepository $userDeleteRepository, GetAllFormRequestByUser $getAllFormRequestByUser, DayOffFormDeleter $dayOffFormDeleter, DayOffFormRequestDeleter $dayOffFormRequestDeleter)
    {
        $this->findUserById = $findUserById;
        $this->userDeleteRepository = $userDeleteRepository;
        $this->getAllFormRequestByUser = $getAllFormRequestByUser;
        $this->dayOffFormDeleter =$dayOffFormDeleter;
        $this->dayOffFormRequestDeleter = $dayOffFormRequestDeleter;
    }

    public function __invoke(UserByIdRequest $userByIdRequest)
    {
        $userEntity = $this->findUserById->__invoke($userByIdRequest);

        if (null === $userEntity) {
            throw new UserNotFoundException($userByIdRequest->userId());
        }

        $dayOffFormAndDayOffFormRequestCollection = $this->mappingDayOffFormEntitiesAndDayOffFormRequest($this->getAllFormRequestByUser->__invoke($userEntity));
        $dayOffFormCollection = $dayOffFormAndDayOffFormRequestCollection['dayOffForm'];
        $dayOffFormRequestCollection = $dayOffFormAndDayOffFormRequestCollection['dayOffFormRequest'];

        foreach ($dayOffFormRequestCollection as $dayOffFormRequestEntity) {
            $this->dayOffFormRequestDeleter->__invoke($dayOffFormRequestEntity);
        }

        foreach ($dayOffFormCollection as $dayOffFormEntity) {
            $this->dayOffFormDeleter->__invoke($dayOffFormEntity);
        }

        $this->userDeleteRepository->deleteUser($userEntity);
    }

    public function mappingDayOffFormEntitiesAndDayOffFormRequest(array $dayOffFormRequestByUser): array
    {
        $dayOffFormEntitiesCollection = [];
        $dayOffRequestEntitiesCollection = [];

        foreach ($dayOffFormRequestByUser as $dayOff) {
            if ($dayOff instanceof DayOffFormRequest) {
                array_push($dayOffRequestEntitiesCollection, $dayOff);
            }
            if ($dayOff instanceof DayOffForm) {
                array_push($dayOffFormEntitiesCollection, $dayOff);
            }
        }
        return [
            'dayOffForm' => $dayOffFormEntitiesCollection,
            'dayOffFormRequest' => $dayOffRequestEntitiesCollection
        ];
    }
}
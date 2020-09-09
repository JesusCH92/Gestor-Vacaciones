<?php


namespace App\DayOffForm\ApplicationService;


use App\DayOffForm\ApplicationService\DTO\LastDayOffFormRequestByUserRequest;
use App\DayOffForm\ApplicationService\DTO\StateLastDayOffFormRequestByUser;
use App\DayOffForm\Domain\DayOffRepository;

final class GetLastDayOffFormRequestByUser
{
    private DayOffRepository $dayOffRepository;

    public function __construct(DayOffRepository $dayOffRepository)
    {
        $this->dayOffRepository = $dayOffRepository;
    }

    public function __invoke(LastDayOffFormRequestByUserRequest $lastDayOffFormRequestByUserRequest): ?StateLastDayOffFormRequestByUser
    {
        $lastDayOffFormByUser = $this->dayOffRepository->findLastDayOffFormRequestByUser($lastDayOffFormRequestByUserRequest->user());

        if (!empty($lastDayOffFormByUser)) {
            return new StateLastDayOffFormRequestByUser($lastDayOffFormByUser[0]['statusDayOffForm.statusDayOffForm']);
        }
        return null;
    }
}
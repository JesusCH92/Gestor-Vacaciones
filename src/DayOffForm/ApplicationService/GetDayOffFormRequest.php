<?php

declare(strict_types=1);

namespace App\DayOffForm\ApplicationService;

use App\DayOffForm\ApplicationService\DTO\DayOffFormRequest;
use App\DayOffForm\ApplicationService\DTO\DayOffFormResponse;
use App\DayOffForm\ApplicationService\Exception\InvalidDayOffForm;
use App\DayOffForm\Domain\DTO\DatesDayOffFormRequest;
use App\DayOffForm\Domain\UserDayOffRequestRepository;

final class GetDayOffFormRequest
{
    private UserDayOffRequestRepository $userDayOffRequestRepository;

    public function __construct(UserDayOffRequestRepository $userDayOffRequestRepository)
    {
        $this->userDayOffRequestRepository = $userDayOffRequestRepository;
    }

    public function __invoke(DayOffFormRequest $dayOffFormRequest): DayOffFormResponse
    {
        $dayOffForm = $this->userDayOffRequestRepository->findDayOfFormById($dayOffFormRequest->dayOffFormId());

        if (null === $dayOffForm) {
            throw new InvalidDayOffForm();
        }
        $datesDayOffForm = $this->userDayOffRequestRepository->findByDayOffFormRequestById(new DatesDayOffFormRequest($dayOffForm));

        return new DayOffFormResponse($dayOffForm, $datesDayOffForm);

    }

}
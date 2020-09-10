<?php


namespace App\SuperviseEmployees\ApplicationService;


use App\SuperviseEmployees\ApplicationService\DTO\DayOffFormRequest;
use App\SuperviseEmployees\ApplicationService\DTO\DayOffFormResponse;
use App\SuperviseEmployees\ApplicationService\Exception\InvalidDayOffForm;
use App\SuperviseEmployees\Domain\DTO\DatesDayOffFormRequest;
use App\SuperviseEmployees\Domain\UserDayOffRequestRepository;

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
        if (null === $dayOffForm){
            throw new InvalidDayOffForm();
        }
        $datesDayOffForm = $this->userDayOffRequestRepository->findByDayOffFormRequestById(new DatesDayOffFormRequest($dayOffForm));
        return new DayOffFormResponse($dayOffForm,$datesDayOffForm);

    }

}
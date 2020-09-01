<?php


namespace App\DayOffForm\ApplicationService;


use App\DayOffForm\ApplicationService\DTO\ApproveDayOffFormRequest;
use App\DayOffForm\Domain\DayOffRepository;

final class ApproveDayOffForm
{
    private DayOffRepository $dayOffRepository;

    public function __construct(DayOffRepository $dayOffRepository)
    {
        $this->dayOffRepository = $dayOffRepository;
    }

    public function __invoke(ApproveDayOffFormRequest $approveDayOffFormRequest)
    {
        $this->dayOffRepository->approveDayOffForm($approveDayOffFormRequest->dayOffFormId(),
            $approveDayOffFormRequest->comment(), $approveDayOffFormRequest->supervisorId());

    }
}
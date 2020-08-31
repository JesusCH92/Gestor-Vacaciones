<?php


namespace App\DayOffForm\ApplicationService;

use App\DayOffForm\ApplicationService\DTO\DenyDayOffFormRequest;
use App\DayOffForm\Domain\DayOffRepository;

class DenyDayOffForm
{
    private DayOffRepository $dayOffRepository;

    public function __construct(DayOffRepository $dayOffRepository)
    {
        $this->dayOffRepository = $dayOffRepository;
    }

    public function __invoke(DenyDayOffFormRequest $approveDayOffFormRequest)
    {
        $this->dayOffRepository->denyDayOffForm($approveDayOffFormRequest->dayOffFormId(),
            $approveDayOffFormRequest->comment(), $approveDayOffFormRequest->supervisorId());

    }
}
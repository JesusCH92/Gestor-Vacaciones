<?php

declare(strict_types=1);

namespace App\DayOffForm\ApplicationService;

use App\DayOffForm\ApplicationService\DTO\DenyDayOffFormRequest;
use App\DayOffForm\Domain\DayOffRepository;

final class DenyDayOffForm
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
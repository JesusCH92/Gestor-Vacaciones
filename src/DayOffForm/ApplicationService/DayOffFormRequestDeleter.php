<?php

declare(strict_types = 1);

namespace App\DayOffForm\ApplicationService;

use App\DayOffForm\Domain\DayOffFormDeleteRepository;
use App\Entity\DayOffFormRequest;

final class DayOffFormRequestDeleter
{
    private DayOffFormDeleteRepository $dayOffFormDeleteRepository;

    public function __construct(DayOffFormDeleteRepository $dayOffFormDeleteRepository)
    {
        $this->dayOffFormDeleteRepository = $dayOffFormDeleteRepository;
    }

    public function __invoke(DayOffFormRequest $dayOffFormRequest)
    {
        $this->dayOffFormDeleteRepository->deleteDayOffFormRequest($dayOffFormRequest);
    }
}
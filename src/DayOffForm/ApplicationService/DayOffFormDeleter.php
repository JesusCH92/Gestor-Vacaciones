<?php

declare(strict_types = 1);

namespace App\DayOffForm\ApplicationService;

use App\DayOffForm\Domain\DayOffFormDeleteRepository;
use App\Entity\DayOffForm;
use App\User\Domain\User;

final class DayOffFormDeleter
{
    private DayOffFormDeleteRepository $dayOffFormDeleteRepository;

    public function __construct(DayOffFormDeleteRepository $dayOffFormDeleteRepository)
    {
        $this->dayOffFormDeleteRepository = $dayOffFormDeleteRepository;
    }

    public function __invoke(DayOffForm $dayOffForm)
    {
        $this->dayOffFormDeleteRepository->deleteDayOffForm($dayOffForm);
    }
}
<?php

declare(strict_types=1);

namespace App\DayOffForm\ApplicationService;

use App\DayOffForm\ApplicationService\DTO\DayOffRequest;
use App\DayOffForm\Domain\DayOffRepository;
use App\DayOffForm\Domain\ValueObject\CountDayOffRequest;
use App\DayOffForm\Domain\ValueObject\DayOffSelected;
use App\DayOffForm\Domain\ValueObject\StatusDayOffForm;
use App\Entity\DayOffForm;
use App\Entity\DayOffFormRequest;

final class SaveDayOffRequest
{
    private DayOffRepository $dayOffCrudRepository;

    public function __construct(DayOffRepository $dayOffCrudRepository)
    {
        $this->dayOffCrudRepository = $dayOffCrudRepository;
    }

    public function __invoke(DayOffRequest $dayOffRequest): void
    {
        $statusDayOffForm = new StatusDayOffForm();
        $statusDayOffForm->statusByUserRole($dayOffRequest->typeDayOff(), $dayOffRequest->user()->getRoles()[0]);

        $countDayOffRequest = new  CountDayOffRequest($dayOffRequest->countDayOffRequest());
        $countDayOffRequest->checkCountDaysSelected($dayOffRequest->typeDayOff(),30);
        $dayOffForm = new DayOffForm(
            $dayOffRequest->typeDayOff(),
            $statusDayOffForm,
            null,
            $countDayOffRequest,
            $dayOffRequest->user(),
            null

        );
        $this->dayOffCrudRepository->saveDayOffForm($dayOffForm);

        foreach ($dayOffRequest->daysOff() as $dayOff) {
            $dayOffSelected = new DayOffSelected($dayOff);
            $dayOffSelected->isCorrectDaySelectedTiming(new \DateTime('2021-01-01'), new \DateTime('2022-01-01'));
            $daysOfFormRequest = new DayOffFormRequest($dayOffForm, $dayOffSelected);

            $this->dayOffCrudRepository->saveDayOffFormRequest($daysOfFormRequest);
        }
    }
}
<?php

declare(strict_types=1);

namespace App\DayOff\ApplicationService;

use App\DayOff\ApplicationService\DTO\DayOffRequest;
use App\DayOff\Domain\DayOffRepository;
use App\DayOff\Domain\ValueObject\CountDayOffRequest;
use App\DayOff\Domain\ValueObject\DayOffSelected;
use App\DayOff\Domain\ValueObject\StatusDayOffForm;
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

        foreach ($dayOffRequest->daysOff() as $dayOff) {
            $dayOffSelected = new DayOffSelected($dayOff);
            $dayOffSelected->isCorrectDaySelectedTiming(date("Y-m-d",2021-02-01),date("Y-m-d",2022-01-01));
            $daysOfFormRequest = new DayOffFormRequest($dayOffForm, $dayOffSelected);

            $this->dayOffCrudRepository->saveDayOffFormRequest($daysOfFormRequest);
        }
        $this->dayOffCrudRepository->saveDayOffForm($dayOffForm);
    }
}
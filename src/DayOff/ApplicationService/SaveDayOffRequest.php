<?php

declare(strict_types=1);

namespace App\DayOff\ApplicationService;

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

        $dayOffForm = new DayOffForm(
            $dayOffRequest->typeDayOff(),
            $statusDayOffForm,
            null,
            new  CountDayOffRequest($dayOffRequest->countDayOffRequest()),
            $dayOffRequest->user(),
            null

        );

        $this->dayOffCrudRepository->saveDayOffForm($dayOffForm);

        foreach ($dayOffRequest->daysOff() as $dayOff) {
            $daysOfFormRequest = new DayOffFormRequest($dayOffForm, new DayOffSelected($dayOff));

            $this->dayOffCrudRepository->saveDayOffFormRequest($daysOfFormRequest);
        }
    }
}
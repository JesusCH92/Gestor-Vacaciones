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
use DateTimeImmutable;

final class SaveDayOffRequest
{
    private DayOffRepository $dayOffRepository;

    public function __construct(DayOffRepository $dayOffRepository)
    {
        $this->dayOffRepository = $dayOffRepository;
    }

    public function __invoke(DayOffRequest $dayOffRequest): void
    {
        $dayOffForm = $this->mappingDayOffFormFromDayOffRequest($dayOffRequest, $dayOffRequest->remainingDaysByType());
        $dayOffRequestCollection = $this->mappingDayOffFormRequestFromDayOffRequest($dayOffRequest, $dayOffForm);

        $this->dayOffRepository->saveDayOffForm($dayOffForm, $dayOffRequestCollection);

    }

    public function mappingDayOffFormFromDayOffRequest(DayOffRequest $dayOffRequest, int $remainingDays): DayOffForm
    {
        $statusDayOffForm = new StatusDayOffForm();
        // ! Roles got from SymfonyUser entity;
        $roleUser = $dayOffRequest->user()->getRoles()[0];
        $statusDayOffForm->statusByUserRole($roleUser);

        $countDayOffRequest = new  CountDayOffRequest(count($dayOffRequest->daysOffSelected()));
        $countDayOffRequest->checkCountDaysSelected($dayOffRequest->typeDayOffSelected(), $remainingDays);

        return new DayOffForm(
            $dayOffRequest->typeDayOffSelected(),
            $statusDayOffForm,
            null,
            $countDayOffRequest,
            new DateTimeImmutable(),
            $dayOffRequest->user(),
            null,
            $dayOffRequest->calendar()

        );
    }

    public function mappingDayOffFormRequestFromDayOffRequest(
        DayOffRequest $dayOffRequest,
        DayOffForm $dayOffForm
    ): array {
        $dayOffFormRequestCollection = [];

        $initDateDayOffRequest = $dayOffRequest->calendar()->dayOffConfig()->initDateDayOffRequest();
        $endDateDayOffRequest = $dayOffRequest->calendar()->dayOffConfig()->endDateDayOffRequest();
        $typeDayOffSelected = $dayOffRequest->typeDayOffSelected();

        foreach ($dayOffRequest->daysOffSelected() as $dayOff) {
            $dayOffSelected = new DayOffSelected($dayOff);
            $dayOffSelectedValid = $dayOffSelected->guardIfIsValidDate($typeDayOffSelected, $initDateDayOffRequest,
                $endDateDayOffRequest);

            $dayOfFormRequest = new DayOffFormRequest($dayOffForm, $dayOffSelectedValid);

            array_push($dayOffFormRequestCollection, $dayOfFormRequest);
        }
        return $dayOffFormRequestCollection;
    }
}
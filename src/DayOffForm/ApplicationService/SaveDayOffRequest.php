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
        $statusDayOffForm->statusByUserRole($dayOffRequest->user()->getRoles()[0]); // ! It's SymfonyUser

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

    public function mappingDayOffFormRequestFromDayOffRequest(DayOffRequest $dayOffRequest, DayOffForm $dayOffForm): array
    {
        $dayOffFormRequestCollection = [];

        foreach ($dayOffRequest->daysOffSelected() as $dayOff) {

            $initDateDayOffRequest = $dayOffRequest->calendar()->dayOffConfig()->initDateDayOffRequest();
            $endDateDayOffRequest = $dayOffRequest->calendar()->dayOffConfig()->endDateDayOffRequest();

            $dayOffSelected = new DayOffSelected($dayOff);
            //throw an exception if the date selected is not in between the init date and the end date to select a day off
            $dayOffSelected->validCorrectDaySelectedTiming($initDateDayOffRequest, $endDateDayOffRequest);
            $dayOffSelected->validDateBeforeThanCurrentDateByTypeDayOff($dayOffRequest->typeDayOffSelected());
            $dayOfFormRequest = new DayOffFormRequest($dayOffForm, $dayOffSelected);

            array_push($dayOffFormRequestCollection, $dayOfFormRequest);
        }
        return $dayOffFormRequestCollection;
    }
}
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
        $dayOffFormCollection = $this->dayOffRepository->findByUserAndStatusDayOffForm($dayOffRequest->user(), $dayOffRequest->calendar(), $dayOffRequest->typeDayOffSelected());

        $remainingDays = $this->calculateRemainingDaysByType($dayOffFormCollection, $dayOffRequest->typeDayOffCollection()[$dayOffRequest->typeDayOffSelected()]);

        $dayOffForm = $this->mappingDayOffFormFromDayOffRequest($dayOffRequest, $remainingDays);
        $dayOffRequestCollection = $this->mappingDayOffFormRequestFromDayOffRequest($dayOffRequest, $dayOffForm);

        $this->dayOffRepository->saveDayOffForm($dayOffForm, $dayOffRequestCollection);

    }

    public function calculateRemainingDaysByType(array $dayOffFormCollection, int $totalCount)
    {
        $count = 0;
        if (!empty($dayOffFormCollection)) {
            foreach ($dayOffFormCollection as $dayOffForm) {
                $count += $dayOffForm['countDayOffRequest.countDayOffRequest'];
            }
            return $totalCount - $count;
        }
        return $totalCount;
    }

    public function mappingDayOffFormFromDayOffRequest(DayOffRequest $dayOffRequest, int $remainingDays): DayOffForm
    {
        $statusDayOffForm = new StatusDayOffForm();
        $statusDayOffForm->statusByUserRole($dayOffRequest->user()->getRoles()[0]);

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
            $dayOffSelected->isCorrectDaySelectedTiming($initDateDayOffRequest, $endDateDayOffRequest);

            $dayOfFormRequest = new DayOffFormRequest($dayOffForm, $dayOffSelected);

            array_push($dayOffFormRequestCollection, $dayOfFormRequest);
        }
        return $dayOffFormRequestCollection;
    }
}
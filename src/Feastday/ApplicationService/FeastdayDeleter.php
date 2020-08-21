<?php

declare(strict_types = 1);

namespace App\Feastday\ApplicationService;

use App\Calendar\ApplicationService\Exception\CalendarNotFoundException;
use App\Feastday\ApplicationService\DTO\FeastdayRequest;
use App\Feastday\ApplicationService\Exception\FeastdayNotFoundException;
use App\Feastday\Domain\FeastdayDeleterRepository;
use App\Feastday\Domain\ValueObject\FeastdayDate;
use Ramsey\Uuid\Nonstandard\Uuid;

final class FeastdayDeleter
{
    private FeastdayDeleterRepository $feastdayDeleterRepository;

    public function __construct(FeastdayDeleterRepository $feastdayDeleterRepository)
    {
        $this->feastdayDeleterRepository = $feastdayDeleterRepository;
    }

    public function __invoke(FeastdayRequest $feastdayRequest)
    {
        $calendarId = $feastdayRequest->calendarId();
        if (!Uuid::isValid($calendarId)) {
            throw new CalendarNotFoundException();
        }
        $feastdayDate = $feastdayRequest->feastdayDate();

        $feastdayDateValueObject = new FeastdayDate($feastdayDate);
        $feastdayEntity = $this->feastdayDeleterRepository->findFeastday($calendarId, $feastdayDateValueObject->feastdayDate());

        if (null === $feastdayEntity) {
            throw new FeastdayNotFoundException();
        }

        $this->feastdayDeleterRepository->deleteFeastday($feastdayEntity);
    }
}
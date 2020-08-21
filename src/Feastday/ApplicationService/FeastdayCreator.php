<?php

declare(strict_types = 1);

namespace App\Feastday\ApplicationService;

use App\Calendar\ApplicationService\Exception\CalendarNotFoundException;
use App\Entity\FeastDay;
use App\Feastday\ApplicationService\DTO\FeastdayRequest;
use App\Feastday\ApplicationService\DTO\FeastdayResponse;
use App\Feastday\ApplicationService\Exception\FeastdayAlreadyExistsException;
use App\Feastday\Domain\FeastdayRepository;
use App\Feastday\Domain\ValueObject\FeastdayDate;

final class FeastdayCreator
{
    private FeastdayRepository $feastdayRepository;

    public function __construct(FeastdayRepository $feastdayRepository)
    {
        $this->feastdayRepository = $feastdayRepository;
    }

    public function __invoke(FeastdayRequest $feastdayRequest)
    {
        $calendarId = $feastdayRequest->calendarId();   // ! lanzar la excepcion si esl id no es Uuid
        $feastdayDate = $feastdayRequest->feastdayDate();

        $calendarEntity = $this->feastdayRepository->getCalendarByCalendarId($calendarId);

        if (null === $calendarEntity) {
            throw new CalendarNotFoundException();
        }

        $feastdayDateValueObject = new FeastdayDate($feastdayDate);
        $feastdayExist = $this->feastdayRepository->findFeastday($calendarId, $feastdayDateValueObject->feastdayDate());

        if (null !== $feastdayExist) {
            throw new FeastdayAlreadyExistsException($feastdayDate);
        }

        
        $feastdayEntity = new FeastDay(
            $feastdayDateValueObject,
            $calendarEntity
        );

        $this->feastdayRepository->saveFeastday($feastdayEntity);

        return new FeastdayResponse($feastdayDate);
    }
}
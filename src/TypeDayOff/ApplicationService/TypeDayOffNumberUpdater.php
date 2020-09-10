<?php

declare(strict_types = 1);

namespace App\TypeDayOff\ApplicationService;

use App\Calendar\ApplicationService\Exception\CalendarNotFoundException;
use App\TypeDayOff\ApplicationService\DTO\TypeDayOffRequest;
use App\TypeDayOff\Domain\TypeDayOffRepository;
use Ramsey\Uuid\Nonstandard\Uuid;

final class TypeDayOffNumberUpdater
{
    private TypeDayOffRepository $typeDayOffRepository;

    public function __construct(TypeDayOffRepository $typeDayOffRepository)
    {
        $this->typeDayOffRepository = $typeDayOffRepository;
    }

    public function __invoke(TypeDayOffRequest $typeDayOffRequest)
    {
        $calendarId = $typeDayOffRequest->calendarId();

        if (!Uuid::isValid($calendarId)) {
            throw new CalendarNotFoundException();
        }

        $dayOffType = $typeDayOffRequest->dayOffType();
        $typeDayOffEntity = $this->typeDayOffRepository->getTypeDayOff($calendarId, $dayOffType);

        if (null === $typeDayOffEntity) {
            throw new CalendarNotFoundException();
        }
        
        $typeDayOffEntity->countDayOff()->setCountDayOff(
            intval($typeDayOffRequest->dayOffNumber())
        );

        $this->typeDayOffRepository->saveTypeDayOff($typeDayOffEntity);
    }
}
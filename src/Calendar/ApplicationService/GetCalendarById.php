<?php

declare(strict_types=1);

namespace App\Calendar\ApplicationService;

use App\Calendar\ApplicationService\DTO\CalendarByIdResponse;
use App\Calendar\ApplicationService\DTO\CalendarConfigRequest;
use App\Calendar\ApplicationService\Exception\CalendarNotFoundException;
use App\Calendar\Domain\CalendarConfigRepository;
use Ramsey\Uuid\Nonstandard\Uuid;

final class GetCalendarById
{
    private CalendarConfigRepository $calendarConfigRepository;

    public function __construct(CalendarConfigRepository $calendarConfigRepository)
    {
        $this->calendarConfigRepository = $calendarConfigRepository;
    }

    public function __invoke(CalendarConfigRequest $calendarConfigRequest): CalendarByIdResponse
    {
        if (!Uuid::isValid($calendarConfigRequest->calendarId())) {
            throw new CalendarNotFoundException();
        }

        $calendarEntity = $this->calendarConfigRepository->getCalendarByCalendarId($calendarConfigRequest);

        if (null === $calendarEntity) {
            throw new CalendarNotFoundException();
        }
        return new CalendarByIdResponse($calendarEntity);

    }
}
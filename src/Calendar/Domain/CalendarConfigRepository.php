<?php

declare(strict_types = 1);

namespace App\Calendar\Domain;

use App\Calendar\ApplicationService\DTO\CalendarConfigRequest;
use App\Entity\Calendar;

interface CalendarConfigRepository
{
    public function getCalendarByCalendarId(CalendarConfigRequest $calendarConfigRequest): Calendar;
    public function getFeastdayByCalendarId(CalendarConfigRequest $calendarConfigRequest): array;
    public function getTypeDayOffByCalendarId(CalendarConfigRequest $calendarConfigRequest): array;
}
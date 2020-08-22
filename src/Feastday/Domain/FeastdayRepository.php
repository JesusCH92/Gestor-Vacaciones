<?php

declare(strict_types = 1);

namespace App\Feastday\Domain;

use App\Entity\Calendar;
use App\Entity\FeastDay;
use DateTimeImmutable;

interface FeastdayRepository
{
    public function getCalendarByCalendarId(string $calendarId): ?Calendar;
    public function findFeastday(string $calendarId, DateTimeImmutable $feastdaydate): ?FeastDay;
    public function saveFeastday(FeastDay $feastdayEntity): void;
}
<?php

declare(strict_types=1);

namespace App\Feastday\Domain;

use App\Entity\FeastDay;
use DateTimeImmutable;

interface FeastdayDeleterRepository
{
    public function findFeastday(string $calendarId, DateTimeImmutable $feastdaydate): ?FeastDay;

    public function deleteFeastday(FeastDay $feastdayEntity): void;
}
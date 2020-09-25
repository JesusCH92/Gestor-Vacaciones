<?php

declare(strict_types=1);

namespace App\TypeDayOff\Domain;

use App\Entity\TypeDayOff;

interface TypeDayOffRepository
{
    public function getTypeDayOff(string $calendarId, string $dayoffType): ?TypeDayOff;

    public function saveTypeDayOff(TypeDayOff $typeDayOff): void;
}
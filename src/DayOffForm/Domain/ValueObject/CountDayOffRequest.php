<?php


namespace App\DayOffForm\Domain\ValueObject;

use App\DayOffForm\Domain\Exception\InvalidCountDayOffRequest;
use App\DayOffForm\Domain\Exception\InvalidCountNoDaysSelected;
use App\TypeDayOff\Domain\Constants\DayOff;
use Doctrine\ORM\Mapping as ORM;

/** @ORM\Embeddable */
final class CountDayOffRequest
{
    /** @ORM\Column(type="integer") */
    private int $countDayOffRequest;

    public function __construct(int $countDayOffRequest)
    {
        $this->guardIsPositive($countDayOffRequest);
        $this->countDayOffRequest = $countDayOffRequest;
    }

    public function countDayOffRequest(): int
    {
        return $this->countDayOffRequest;
    }

    public function checkCountDaysSelected(string $typeDayOff, int $remainingDaysByType): void
    {
        if (DayOff::HOLIDAY === $typeDayOff) {
            if ($this->countDayOffRequest > $remainingDaysByType) {
                throw new InvalidCountDayOffRequest($remainingDaysByType);
            }
        }

        if (DayOff::PERSONAL === $typeDayOff) {
            if ($this->countDayOffRequest > $remainingDaysByType) {
                throw new InvalidCountDayOffRequest($remainingDaysByType);
            }
        }
    }

    private function isCountPositive(int $count): bool
    {
        return 0 >= $count;
    }

    private function guardIsPositive(int $count): void
    {
        if ($this->isCountPositive($count)) {
            throw new InvalidCountNoDaysSelected($count);
        }
    }
}
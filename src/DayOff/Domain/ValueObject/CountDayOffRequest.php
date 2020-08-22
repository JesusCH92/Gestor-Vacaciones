<?php


namespace App\DayOff\Domain\ValueObject;

use App\DayOff\Domain\Exception\InvalidCountDayOffRequest;
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

    /**
     * @return int
     */
    public function countDayOffRequest(): int
    {
        return $this->countDayOffRequest;
    }

    public function checkCountDaysSelected(string $typeDayOff, int $remainingDaysByType): void
    {
        if ('HOLIDAY' === $typeDayOff) {
            if ($this->countDayOffRequest > $remainingDaysByType) {
                throw new InvalidCountDayOffRequest($remainingDaysByType);
            }

        }

        if ('PERSONAL' === $typeDayOff) {
            if ($this->countDayOffRequest > $remainingDaysByType) {
                throw new InvalidCountDayOffRequest($remainingDaysByType);
            }

        }

        if ('OTHER' === $typeDayOff) {
            if ($this->countDayOffRequest > $remainingDaysByType) {
                throw new InvalidCountDayOffRequest($remainingDaysByType);
            }

        }

    }

    private function isCountPositive(int $count): bool
    {
        return 0 > $count;
    }

    private function guardIsPositive(int $count): void
    {
        if ($this->isCountPositive($count)) {
            //throw new ();
        }
    }
}
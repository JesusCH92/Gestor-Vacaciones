<?php


namespace App\DayOffForm\Domain\ValueObject;

use App\DayOffForm\Domain\Exception\InvalidCountDayOffRequest;
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
        if ('Holiday' === $typeDayOff) {
            if ($this->countDayOffRequest > $remainingDaysByType) {
                throw new InvalidCountDayOffRequest($remainingDaysByType);
            }

        }

        if ('Personal' === $typeDayOff) {
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
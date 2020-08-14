<?php

declare(strict_types = 1);

namespace App\TypeDayOff\Domain\ValueObject;

use Doctrine\ORM\Mapping as ORM;
use App\TypeDayOff\Domain\Exception\NegativeCountDayOffException;

/**
 * @ORM\Embeddable
 */
final class CountDayOff
{
    /**
     * @ORM\Column(type="integer", name="count_day_off")
     */
    private $countDayOff;

    public function __construct(int $countDayOff)
    {
        $this->guardIsPositive($countDayOff);
        $this->countDayOff = $countDayOff;
    }

    private function guardIsPositive(int $count): void
    {
        if ($this->isIntegerPositive($count)) {
            throw new NegativeCountDayOffException();
        }
    }

    private function isIntegerPositive(int $count): bool
    {
        return 0 > $count;
    }

    public function countDayOff(): int
    {
        return $this->countDayOff;
    }
}
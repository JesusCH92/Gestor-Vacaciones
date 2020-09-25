<?php

declare(strict_types=1);

namespace App\TypeDayOff\Domain\ValueObject;

use App\TypeDayOff\Domain\Exception\NegativeCountDayOffException;
use Doctrine\ORM\Mapping as ORM;

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
        $this->setCountDayOff($countDayOff);
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

    public function setCountDayOff(int $dayOffNumber): void
    {
        $this->countDayOff = $dayOffNumber;
    }

    public function countDayOff(): int
    {
        return $this->countDayOff;
    }
}
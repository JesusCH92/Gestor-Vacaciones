<?php


namespace App\DayOff\Domain\ValueObject;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Embeddable */
final class CountDayOffRequest
{
    /** @ORM\Column(type="integer") */
    private int $countDayOffRequest;

    public function __construct(int $countDayOffRequest)
    {
        $this->countDayOffRequest = $countDayOffRequest;
    }

    /**
     * @return int
     */
    public function getCountDayOffRequest(): int
    {
        return $this->countDayOffRequest;
    }

    public function equals(int $remainingDays)
    {
        if ($this->countDayOffRequest > $remainingDays){
            //throw error exception
        }
    }

}
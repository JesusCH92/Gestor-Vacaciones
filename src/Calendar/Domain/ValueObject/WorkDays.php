<?php

declare(strict_types=1);

namespace App\Calendar\Domain\ValueObject;

use App\Calendar\Domain\Exception\InvalidWorkDayException;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
final class WorkDays
{
    public const MONDAY = '1';
    public const TUESTDAY = '2';
    public const WEDNESDAY = '3';
    public const THURSDAY = '4';
    public const FRIDAY = '5';
    public const SATURDAY = '6';
    public const SUNDAY = '0';

    public static $allowedValues = [
        self::MONDAY,
        self::TUESTDAY,
        self::WEDNESDAY,
        self::THURSDAY,
        self::FRIDAY,
        self::SATURDAY,
        self::SUNDAY
    ];

    /**
     * @ORM\Column(type="json", name="work_days")
     */
    private array $workDays;

    public function __construct(array $workDays)
    {
        $this->setWorkDays($workDays);
    }

    public function setWorkDays(array $workDays)
    {
        foreach ($workDays as $day) {
            if (!in_array($day, static::$allowedValues, true)) {
                throw new InvalidWorkDayException($day);
            }
        }

        $this->workDays = $workDays;
    }

    public function workDays(): array
    {
        return $this->workDays;
    }
}
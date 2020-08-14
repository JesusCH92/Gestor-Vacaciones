<?php

declare(strict_types = 1);

namespace App\Calendar\Domain\ValueObject;

use App\Calendar\Domain\Exception\InvalidWorkingYearException;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
final class WorkingYear
{
    /** 
     * @ORM\Column(type="integer", name="working_year")
     */
    private int $workingYear;

    public function __construct(int $workingYear)
    {
        $this->guardIsValidYear($workingYear);
        $this->workingYear = $workingYear;
    }

    public function workingYear(): int
    {
        return $this->workingYear;
    }

    public function guardIsValidYear(int $year): void
    {
        if ($this->isValidYearForGreaterThanOrEqualTwentyNineteen($year)) {
            throw new InvalidWorkingYearException();
        }
    }

    public function isValidYearForGreaterThanOrEqualTwentyNineteen(int $year): bool
    {
        return 2019 > $year;
    }
}
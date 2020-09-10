<?php

declare(strict_types = 1);

namespace App\Feastday\ApplicationService\DTO;

final class FeastdayResponse
{
    private string $date;

    public function __construct(string $date)
    {
        $this->date = $date;
    }

    public function date(): string
    {
        return $this->date;
    }
}
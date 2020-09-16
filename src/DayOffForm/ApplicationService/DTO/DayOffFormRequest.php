<?php

declare(strict_types=1);

namespace App\DayOffForm\ApplicationService\DTO;

final class DayOffFormRequest
{
    private string $dayOffFormId;

    public function __construct(string $dayOffFormId)
    {
        $this->dayOffFormId = $dayOffFormId;
    }

    public function dayOffFormId(): string
    {
        return $this->dayOffFormId;
    }

}
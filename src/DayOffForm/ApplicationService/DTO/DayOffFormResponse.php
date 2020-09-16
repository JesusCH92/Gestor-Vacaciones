<?php

declare(strict_types=1);

namespace App\DayOffForm\ApplicationService\DTO;

use App\Entity\DayOffForm;

final class DayOffFormResponse
{
    private DayOffForm $dayOffForm;
    private array $dayOffFormRequest;

    public function __construct(DayOffForm $dayOffForm, array $dayOffFormRequest)
    {
        $this->dayOffForm = $dayOffForm;
        $this->dayOffFormRequest = $dayOffFormRequest;
    }

    public function dayOffForm(): DayOffForm
    {
        return $this->dayOffForm;
    }

    public function dayOffFormRequest(): array
    {
        return $this->dayOffFormRequest;
    }
}
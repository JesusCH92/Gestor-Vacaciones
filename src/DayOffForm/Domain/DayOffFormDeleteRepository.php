<?php

declare(strict_types=1);

namespace App\DayOffForm\Domain;

use App\Entity\DayOffForm;
use App\Entity\DayOffFormRequest;

interface DayOffFormDeleteRepository
{
    public function deleteDayOffFormRequest(DayOffFormRequest $dayOffFormRequest): void;

    public function deleteDayOffForm(DayOffForm $dayOffForm): void;
}
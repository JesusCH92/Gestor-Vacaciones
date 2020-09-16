<?php

declare(strict_types=1);

namespace App\DayOffForm\Domain;

use App\DayOffForm\Domain\DTO\DatesDayOffFormRequest;
use App\Entity\DayOffForm;
use App\Entity\Department;

interface UserDayOffRequestRepository
{
    public function findUsersByDepartmentByPendingStatus(Department $department): array;

    public function findByDayOffFormRequestById(DatesDayOffFormRequest $dayOffForm): array;

    public function findDayOfFormById(string $dayOffFormId): ?DayOffForm;
}
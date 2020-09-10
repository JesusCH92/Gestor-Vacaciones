<?php


namespace App\SuperviseEmployees\Domain;


use App\Entity\Department;
use App\SuperviseEmployees\Domain\DTO\DatesDayOffFormRequest;

interface UserDayOffRequestRepository
{
    public function findUsersByDepartmentByPendingStatus(Department $department);
    public function findByDayOffFormRequestById(DatesDayOffFormRequest $dayOffForm): array;
    public function findDayOfFormById(string $dayOffFormId);
}
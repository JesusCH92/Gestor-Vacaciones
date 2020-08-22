<?php

namespace App\Calendar\Domain;

use App\Entity\Company;

interface CalendarByWorkingYearRepository
{
    public function getAllCalendarByCompany(Company $company): array;
}
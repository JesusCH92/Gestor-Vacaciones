<?php

declare(strict_types=1);

namespace App\Company\Domain;

use App\Company\ApplicationService\DTO\CompanyRequest;

interface CompanyRepository
{
    public function updateCompany(CompanyRequest $companyRequest);
}
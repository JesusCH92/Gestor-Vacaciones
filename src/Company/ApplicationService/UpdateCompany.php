<?php

declare(strict_types=1);

namespace App\Company\ApplicationService;

use App\Company\ApplicationService\DTO\CompanyRequest;
use App\Company\Domain\CompanyRepository;

final class UpdateCompany
{
    private CompanyRepository $companyRepository;

    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    public function __invoke(CompanyRequest $companyRequest)
    {
        $this->companyRepository->updateCompany($companyRequest);
    }
}
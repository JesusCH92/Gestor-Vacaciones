<?php

declare(strict_types=1);

namespace App\Company\Infrastructure;

use App\Company\ApplicationService\DTO\CompanyRequest;
use App\Company\Domain\CompanyRepository;
use App\Entity\Company;
use Doctrine\DBAL\Connection;

final class DbalCompanyRepository implements CompanyRepository
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function updateCompany(CompanyRequest $companyRequest)
    {
        $queryBuilder = $this->connection->createQueryBuilder();

        $queryBuilder
            ->update(Company::COMPANYTABLE)     // TODO: he hardcoding el nombre de la tabla
            ->set('company_name', '?')
            ->where('id_company = ?')
            ->setParameter(0, $companyRequest->companyName())
            ->setParameter(1, $companyRequest->companyId());

        $queryBuilder->execute();
    }
}
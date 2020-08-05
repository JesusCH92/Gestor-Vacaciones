<?php

namespace App\Company\Infrastructure;

use App\Company\ApplicationService\DTO\CompanyRequest;
use App\Company\Domain\CompanyRepository;
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
            ->update('company')     // TODO: he hardcoding el nombre de la tabla
            ->set('companyname', '?')
            ->where('id = ?')
            ->setParameter(0, $companyRequest->companyName())
            ->setParameter(1, $companyRequest->companyId());

        $queryBuilder->execute();
    }
}
<?php

declare(strict_types=1);

namespace App\Department\ApplicationService\Exception;

use Exception;
use Throwable;

final class DepartmentNotFoundException extends Exception
{
    public function __construct(string $departmentId, $code = 0, Throwable $previous = null)
    {
        parent::__construct(
            sprintf('Department with id "%s" were not found', $departmentId),
            $code,
            $previous
        );
    }
}
<?php

declare(strict_types = 1);

namespace App\Department\ApplicationService\Exception;

use Exception;
use Throwable;

final class DepartmentCodeIsNotValidException extends Exception
{
    public function __construct(string $departmentCode, $code = 0, Throwable $previous = null)
    {
        parent::__construct(
            sprintf('Department with code "%s" is not valid, must be contents less 10 characters and not blank', $departmentCode),
            $code,
            $previous
        );
    }
}
<?php


namespace App\User\ApplicationService\DTO;


final class UsersByDepartmentByNameResponse
{
    private array $users;

    public function __construct(array $users)
    {
        $this->users = $users;
    }

    public function users(): array
    {
        return $this->users;
    }
}
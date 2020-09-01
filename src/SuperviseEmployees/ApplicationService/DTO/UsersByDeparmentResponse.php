<?php


namespace App\SuperviseEmployees\ApplicationService\DTO;


final class UsersByDeparmentResponse
{
    private array $usersCollection;

    public function __construct(array $usersCollection)
    {
        $this->usersCollection = $usersCollection;
    }

    public function usersCollection(): array
    {
        return $this->usersCollection;
    }
}
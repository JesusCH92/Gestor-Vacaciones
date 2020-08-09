<?php


namespace App\DayOff\ApplicationService;


use App\User\Domain\User;

final class DayOffRequest
{
    private User $user;
    private string $typeDayOff;
    private int $countDayOffRequest;
    private array $daysOff;


    public function __construct(
        User $user,
        string $typeDayOff,
        int $countDayOffRequest,
        array $daysOff
    ) {
        $this->user = $user;
        $this->typeDayOff = $typeDayOff;
        $this->countDayOffRequest = $countDayOffRequest;
        $this->daysOff = $daysOff;
    }

    /**
     * @return User
     */
    public function user(): User
    {
        return $this->user;
    }

    /**
     * @return string
     */
    public function typeDayOff(): string
    {
        return $this->typeDayOff;
    }


    /**
     * @return int
     */
    public function countDayOffRequest(): int
    {
        return $this->countDayOffRequest;
    }

    /**
     * @return array
     */
    public function daysOff(): array
    {
        return $this->daysOff;
    }


}
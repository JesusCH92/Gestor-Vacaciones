<?php

declare(strict_types=1);

namespace App\DayOffForm\ApplicationService;

use App\DayOffForm\ApplicationService\DTO\UserOnDayOffTodayResponse;
use App\DayOffForm\Domain\DayOffRepository;

final class GetUsersOnDayOffToday
{
    private DayOffRepository $dayOffRepository;

    public function __construct(DayOffRepository $dayOffRepository)
    {
        $this->dayOffRepository = $dayOffRepository;
    }

    public function __invoke(): array
    {
        $usersOnDayOff = $this->dayOffRepository->findUsersInDayOffToday();

        return $this->mappingUsersOnDayOff($usersOnDayOff);
    }

    public function mappingUsersOnDayOff(array $usersOnDayOff): array
    {
        $usersOnDayOffCollection = [];
        foreach ($usersOnDayOff as $user) {
            $userOnDayOffToday = new UserOnDayOffTodayResponse($user['email'], $user['name'], $user['lastname'],
                $user['typeDayOff']);
            array_push($usersOnDayOffCollection, $userOnDayOffToday);
        }
        return $usersOnDayOffCollection;
    }
}
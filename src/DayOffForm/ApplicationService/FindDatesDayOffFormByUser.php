<?php


namespace App\DayOffForm\ApplicationService;


use App\DayOffForm\ApplicationService\DTO\UserInDayOffFormByUserIdRequest;
use App\DayOffForm\ApplicationService\DTO\UserInDayOffFormResponse;
use App\DayOffForm\Domain\UsersInDayOffFormRepository;

final class FindDatesDayOffFormByUser
{
    private UsersInDayOffFormRepository $usersInDayOffFormRepository;

    public function __construct(UsersInDayOffFormRepository $usersInDayOffFormRepository)
    {
        $this->usersInDayOffFormRepository = $usersInDayOffFormRepository;
    }

    public function __invoke(UserInDayOffFormByUserIdRequest $userInDayOffFormByUserIdRequest)
    {
        $usersInDayOffApproved = $this->usersInDayOffFormRepository->findDayOffFormRequestByCalendarUserId($userInDayOffFormByUserIdRequest->calendar(),
            $userInDayOffFormByUserIdRequest->userId());
        return $this->mappingUsersInDayOffCollection($usersInDayOffApproved);
    }

    public function mappingUsersInDayOffCollection(array $usersInDayOffApproved): array
    {
        $usersInDayOffCollection = [];
        $codeDayOffForm = array_unique(array_column($usersInDayOffApproved, 'codeDayOffForm'));

        foreach ($codeDayOffForm as $code) {
            $dayOffFormRequestByCode = array_filter($usersInDayOffApproved, function ($userInDayOff) use ($code) {
                return ($code === $userInDayOff['codeDayOffForm']);
            });

            $daysOffFormRequest = [];
            foreach ($dayOffFormRequestByCode as $dayOffFormByCode) {
                array_push($daysOffFormRequest, $dayOffFormByCode['dayOffSelected.dayOffSelected']);
            }

            $userId = $dayOffFormRequestByCode[array_key_first($dayOffFormRequestByCode)]['userId'];
            $email = $dayOffFormRequestByCode[array_key_first($dayOffFormRequestByCode)]['email'];
            $name = $dayOffFormRequestByCode[array_key_first($dayOffFormRequestByCode)]['name'];
            $lastName = $dayOffFormRequestByCode[array_key_first($dayOffFormRequestByCode)]['lastname'];
            $dayOffFormId = $dayOffFormRequestByCode[array_key_first($dayOffFormRequestByCode)]['lastname'];

            $userInDayOffFormResponse = new UserInDayOffFormResponse($userId, $email, $name,
                $lastName, $dayOffFormId, $daysOffFormRequest);

            array_push($usersInDayOffCollection, $userInDayOffFormResponse);
        }
        return $usersInDayOffCollection;
    }
}
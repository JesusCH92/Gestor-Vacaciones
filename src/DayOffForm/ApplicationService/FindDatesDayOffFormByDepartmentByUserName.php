<?php


namespace App\DayOffForm\ApplicationService;


use App\DayOffForm\ApplicationService\DTO\DatesDayOffByDepartmentByUserNameRequest;
use App\DayOffForm\ApplicationService\DTO\UserInDayOffFormResponse;
use App\DayOffForm\Domain\DayOffRepository;

class FindDatesDayOffFormByDepartmentByUserName
{
    private DayOffRepository $dayOffRepository;

    public function __construct(DayOffRepository $dayOffRepository)
    {
        $this->dayOffRepository = $dayOffRepository;
    }

    public function __invoke(DatesDayOffByDepartmentByUserNameRequest $dayOffByDepartmentByUserNameRequest): array
    {

        $usersInDayOffApproved = $this->dayOffRepository->findByDepartmentAndUsername($dayOffByDepartmentByUserNameRequest->calendar(),
            $dayOffByDepartmentByUserNameRequest->userName(),
            $dayOffByDepartmentByUserNameRequest->departmentId());

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

            $userInDayOffFormResponse = new UserInDayOffFormResponse($userId, $email,$name,
                $lastName, $dayOffFormId, $daysOffFormRequest);

            array_push($usersInDayOffCollection, $userInDayOffFormResponse);
        }
        return $usersInDayOffCollection;
    }
}
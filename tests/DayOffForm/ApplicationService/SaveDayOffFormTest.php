<?php


namespace App\Tests\DayOffForm\ApplicationService;

use App\Calendar\Domain\ValueObject\DayOffConfig;
use App\Calendar\Domain\ValueObject\WorkDays;
use App\Calendar\Domain\ValueObject\WorkingYear;
use App\DayOffForm\ApplicationService\DTO\DayOffRequest;
use App\DayOffForm\ApplicationService\SaveDayOffRequest;
use App\DayOffForm\Domain\Exception\InvalidCountDayOffRequest;
use App\DayOffForm\Domain\Exception\InvalidCountNoDaysSelected;
use App\DayOffForm\Domain\Exception\InvalidDayOffSelectedException;
use App\DayOffForm\Domain\Exception\InvalidLowerDateSelectedThanCurrentDate;
use App\Entity\Calendar;
use App\Entity\Company;
use App\Entity\Department;
use App\Tests\DayOffForm\Infrastructure\OrmDayOffRepositoryDummy;
use App\User\Domain\ValueObject\Roles;
use App\User\Infrastructure\Model\SymfonyUser;
use PHPUnit\Framework\TestCase;

class SaveDayOffFormTest extends TestCase
{
    /**
     * @test
     */
    public function notValidCountDaysSelected()
    {
        $this->expectException(InvalidCountDayOffRequest::class);

        $company = new Company();
        $user = new SymfonyUser('miriam@gmail.com', 'miriam', 'lopez', '663768798', new Roles('ROLE_SUPERVISOR'),
            'miriam', new Department('TFM', 't', $company), $company);
        $calendar = new Calendar(new DayOffConfig('2020-01-01', '2021-01-31'), new WorkDays(["1", "2", "3"]),
            new Company(), new WorkingYear(2020));

        $dayOffRequest = new DayOffRequest($user, $calendar, 'Holiday', ['2020-08-01'],
            ['Holiday' => 3, 'Personal' => 1], [], 0);

        $ormDayOffRepositoryDummy = new OrmDayOffRepositoryDummy();
        $saveDayOffRequest = new SaveDayOffRequest($ormDayOffRepositoryDummy);
        $saveDayOffRequest->__invoke($dayOffRequest);
    }

    /**
     * @test
     */
    public function notValidDateBeforeThanCurrentDateByTypeDayOff()
    {
        $this->expectException(InvalidLowerDateSelectedThanCurrentDate::class);

        $company = new Company();
        $user = new SymfonyUser('miriam@gmail.com', 'miriam', 'lopez', '663768798', new Roles('ROLE_SUPERVISOR'),
            'miriam', new Department('TFM', 't', $company), $company);
        $calendar = new Calendar(new DayOffConfig('2020-01-01', '2021-01-31'), new WorkDays(["1", "2", "3"]),
            new Company(), new WorkingYear(2020));

        $dayOffRequest = new DayOffRequest($user, $calendar, 'Holiday', ['2019-08-01'],
            ['Holiday' => 40, 'Personal' => 1], [], 30);

        $ormDayOffRepositoryDummy = new OrmDayOffRepositoryDummy();
        $saveDayOffRequest = new SaveDayOffRequest($ormDayOffRepositoryDummy);

        $saveDayOffRequest->__invoke($dayOffRequest);
    }

    /**
     * @test
     */
    public function notCorrectDaySelectedTiming()
    {
        $this->expectException(InvalidDayOffSelectedException::class);

        $company = new Company();
        $user = new SymfonyUser('miriam@gmail.com', 'miriam', 'lopez', '663768798', new Roles('ROLE_SUPERVISOR'),
            'miriam', new Department('TFM', 't', $company), $company);
        $calendar = new Calendar(new DayOffConfig('2020-01-01', '2021-01-31'), new WorkDays(["1", "2", "3"]),
            new Company(), new WorkingYear(2020));

        $dayOffRequest = new DayOffRequest($user, $calendar, 'Holiday', ['2021-08-01'],
            ['Holiday' => 40, 'Personal' => 1], [], 30);

        $ormDayOffRepositoryDummy = new OrmDayOffRepositoryDummy();
        $saveDayOffRequest = new SaveDayOffRequest($ormDayOffRepositoryDummy);

        $saveDayOffRequest->__invoke($dayOffRequest);
    }

    /**
     * @test
     */
    public function notDateSelected()
    {
        $this->expectException(InvalidCountNoDaysSelected::class);

        $company = new Company();
        $user = new SymfonyUser('miriam@gmail.com', 'miriam', 'lopez', '663768798', new Roles('ROLE_SUPERVISOR'),
            'miriam', new Department('TFM', 't', $company), $company);
        $calendar = new Calendar(new DayOffConfig('2020-01-01', '2021-01-31'), new WorkDays(["1", "2", "3"]),
            new Company(), new WorkingYear(2020));

        $dayOffRequest = new DayOffRequest($user, $calendar, 'Holiday', [],
            ['Holiday' => 40, 'Personal' => 1], [], 30);

        $ormDayOffRepositoryDummy = new OrmDayOffRepositoryDummy();
        $saveDayOffRequest = new SaveDayOffRequest($ormDayOffRepositoryDummy);

        $saveDayOffRequest->__invoke($dayOffRequest);
    }
}
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
use App\Tests\DayOffForm\Infrastructure\OrmDayOffRepositorySpy;
use App\User\Domain\ValueObject\Roles;
use App\User\Infrastructure\Model\SymfonyUser;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Constraints\Date;

class SaveDayOffFormTest extends TestCase
{
    /**
     * @test
     */
    public function throwExceptionIfNumberOfDaysSelectedIsInvalid()
    {
        $this->expectException(InvalidCountDayOffRequest::class);

        $company = new Company();
        $user = new SymfonyUser('miriam@gmail.com', 'miriam', 'lopez', '663768798', new Roles('ROLE_SUPERVISOR'),
            'miriam', new Department('TFM', 't', $company), $company);

        $date = new \DateTime('now');
        $currentYear = $date->format('Y');

        $calendar = new Calendar(new DayOffConfig($currentYear.'-01-01', $currentYear.'-12-31'), new WorkDays(["1", "2", "3"]),
            new Company(), new WorkingYear(2020));

        $currentDate =$date->format('Y-m-d');

        $dayOffRequest = new DayOffRequest($user, $calendar, 'Holiday', [$currentDate],
            ['Holiday' => 3, 'Personal' => 1], [], 0);

        $ormDayOffRepositoryDummy = new OrmDayOffRepositoryDummy();
        $saveDayOffRequest = new SaveDayOffRequest($ormDayOffRepositoryDummy);
        $saveDayOffRequest->__invoke($dayOffRequest);
    }

    /**
     * @test
     */
    public function throwExceptionIfDateIsBeforeThanCurrentDateDependingOfTypeDayOff()
    {
        $this->expectException(InvalidLowerDateSelectedThanCurrentDate::class);

        $company = new Company();
        $user = new SymfonyUser('miriam@gmail.com', 'miriam', 'lopez', '663768798', new Roles('ROLE_SUPERVISOR'),
            'miriam', new Department('TFM', 't', $company), $company);

        $date = new \DateTime('now');
        $currentYear = $date->format('Y');

        $calendar = new Calendar(new DayOffConfig($currentYear.'-01-01', $currentYear.'-12-31'), new WorkDays(["1", "2", "3"]),
            new Company(), new WorkingYear(2020));

        $dayOffRequest = new DayOffRequest($user, $calendar, 'Holiday', [strval(intval($currentYear)-1).'-08-01'],
            ['Holiday' => 40, 'Personal' => 1], [], 30);

        $ormDayOffRepositoryDummy = new OrmDayOffRepositoryDummy();
        $saveDayOffRequest = new SaveDayOffRequest($ormDayOffRepositoryDummy);

        $saveDayOffRequest->__invoke($dayOffRequest);
    }

    /**
     * @test
     */
    public function throwExceptionIfSelectedDateIsNotBetweenRangesOfDayOffRequest()
    {
        $this->expectException(InvalidDayOffSelectedException::class);

        $company = new Company();
        $user = new SymfonyUser('miriam@gmail.com', 'miriam', 'lopez', '663768798', new Roles('ROLE_SUPERVISOR'),
            'miriam', new Department('TFM', 't', $company), $company);

        $date = new \DateTime('now');
        $currentYear = $date->format('Y');

        $calendar = new Calendar(new DayOffConfig($currentYear.'-01-01', $currentYear.'-12-31'), new WorkDays(["1", "2", "3"]),
            new Company(), new WorkingYear(2020));

        $dayOffRequest = new DayOffRequest($user, $calendar, 'Holiday', [strval(intval($currentYear)+1).'-08-01'],
            ['Holiday' => 40, 'Personal' => 1], [], 30);

        $ormDayOffRepositoryDummy = new OrmDayOffRepositoryDummy();
        $saveDayOffRequest = new SaveDayOffRequest($ormDayOffRepositoryDummy);

        $saveDayOffRequest->__invoke($dayOffRequest);
    }

    /**
     * @test
     */
    public function throwExceptionIfDayOffRequestIsEmpty()
    {
        $this->expectException(InvalidCountNoDaysSelected::class);

        $company = new Company();
        $user = new SymfonyUser('miriam@gmail.com', 'miriam', 'lopez', '663768798', new Roles('ROLE_SUPERVISOR'),
            'miriam', new Department('TFM', 't', $company), $company);

        $date = new \DateTime('now');
        $currentYear = $date->format('Y');

        $calendar = new Calendar(new DayOffConfig($currentYear.'-01-01', $currentYear.'-12-31'), new WorkDays(["1", "2", "3"]),
            new Company(), new WorkingYear(2020));

        $dayOffRequest = new DayOffRequest($user, $calendar, 'Holiday', [],
            ['Holiday' => 40, 'Personal' => 1], [], 30);

        $ormDayOffRepositoryDummy = new OrmDayOffRepositoryDummy();
        $saveDayOffRequest = new SaveDayOffRequest($ormDayOffRepositoryDummy);

        $saveDayOffRequest->__invoke($dayOffRequest);
    }

    /**
     * @test
     */
    public function shouldSaveDayOffForm()
    {
        $company = new Company();
        $user = new SymfonyUser('miriam@gmail.com', 'miriam', 'lopez', '663768798', new Roles('ROLE_SUPERVISOR'),
            'miriam', new Department('TFM', 't', $company), $company);

        $date = new \DateTime('now');
        $currentYear = $date->format('Y');

        $calendar = new Calendar(new DayOffConfig($currentYear.'-01-01', $currentYear.'-12-31'), new WorkDays(["1", "2", "3"]),
            new Company(), new WorkingYear(2020));

        $currentDate = $date->format('Y-m-d');

        $dayOffRequest = new DayOffRequest($user, $calendar, 'Holiday', [$currentDate],
            ['Holiday' => 3, 'Personal' => 1], [], 2);

        $ormDayOffRepositorySpy = new OrmDayOffRepositorySpy();
        $saveDayOffRequest = new SaveDayOffRequest($ormDayOffRepositorySpy);
        $saveDayOffRequest->__invoke($dayOffRequest);

        $this->assertTrue($ormDayOffRepositorySpy->verify());
    }
}